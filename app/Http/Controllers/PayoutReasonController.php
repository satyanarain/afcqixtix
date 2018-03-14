<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\PayoutReason;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PayoutReason\UpdatePayoutReasonRequest;
use App\Http\Requests\PayoutReason\StorePayoutReasonRequest;
use App\Repositories\PayoutReason\PayoutReasonRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PayoutReasonController extends Controller {

    protected $payout_reasons;

    public function __construct(
    PayoutReasonRepositoryContract $payout_reasons
    ) {
        $this->payout_reasons = $payout_reasons;
    }

    /**
     * Display a listing of the resource.
     ** @Author created by satya 5.2.2018
     * @return Response
     */
 public function index() {
                $payout_reasons = DB::table('payout_reasons')
                ->orderby('payout_reasons.order_number')       
                ->get();
                return view('payout_reasons.index',compact('payout_reasons'));
    }
    
 /**
     * Display a listing of the resource.
     ** @Author created by satya 4-01-2018 
     * @return Response
     */    

    
      public function sortOrder($id) {
        $array = explode(',', $id);
       $k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('payout_reasons')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
                $sql = DB::table('payout_reasons')->select('*')
                   ->orderby('payout_reasons.order_number')       
                ->get();
        ?>
                <thead>
                    <tr>  <th>Payout Reason</th>
                        <th>Order Number</th>
                        <th>Short Reason</th>
                        <th>Reason Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($sql as $value) {
                ?>
                            <tr class="nor_f">
                              <td><?php echo $value->payout_reason; ?></td>
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->short_reason ?></td>
                                <td><?php echo $value->reason_description ?></td>
                                <td><a  href="<?php echo route("payout_reasons.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" onclick="viewDetails(<?php echo $value->id ?>,'view_detail')"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    public function orderList() {
        
       $sql = DB::table('payout_reasons')->select('*')
                 ->orderby('payout_reasons.order_number')       
                ->get();
        ?>
                      
        <?php foreach ($sql as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->payout_reason; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->short_reason; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->reason_description; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
    
    public function viewDetail($id) {
       $value = DB::table('payout_reasons')->select('*')
                ->where('payout_reasons.id',$id) 
               ->orderby('payout_reasons.order_number') 
                ->first();
       
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-cc-mastercard"></span>&nbsp;Payout Reason</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Payout Reason</b></td>
                        <td class="table_normal"><?php  echo $value->payout_reason; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Short Reason</b></td>
                        <td class="table_normal"><?php  echo $value->short_reason; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Reason Description</b></td>
                        <td class="table_normal"><?php  echo $value->reason_description; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td class="table_normal"><?php echo $value->order_number; ?></td>
                    </tr>
                  </table>  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <?php   
    }
    
    
 public function Previous() {
    $payout_reasons = DB::table('payout_reasons')->select('*','payout_reasons.id as id')
                ->leftjoin('services', 'payout_reasons.service_id', '=', 'services.id')
                ->get();
        return view('payout_reasons.previous')->withPayoutReasons($payout_reasons);
    }

    public function create() {
     return view('payout_reasons.create');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param PayoutReason $payout_reasons
     * @return Response
     * @Author created by satya 5.2.2018 
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param PayoutReason $payout_reasons
     * @return Response
     * * @Author created by satya 5.2.2018
     */
    public function store(StorePayoutReasonRequest $payout_reasonsRequest) {
        $getInsertedId = $this->payout_reasons->create($payout_reasonsRequest);
        return redirect()->route('payout_reasons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
//    public function show($id) {
//                       $payout_reasons = DB::table('payout_reasons')->select('*','payout_reasons.id as id','trip_cancellation_reason_category_masters.name as trip_cancellation_reason_category_master_id')
//                ->leftjoin('users', 'users.id', '=', 'payout_reasons.user_id')
//                ->leftjoin('trip_cancellation_reason_category_masters', 'trip_cancellation_reason_category_masters.id', '=', 'payout_reasons.trip_cancellation_reason_category_master_id')
//                 ->orderby('payout_reasons.order_number')       
//                ->get();
//                return view('payout_reasons.index',compact('payout_reasons'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @Author created by satya 5.2.2018
     * @return Response
     */
    public function edit($id) {
        $payout_reasons = PayoutReason::findOrFail($id);
        return view('payout_reasons.edit',compact('payout_reasons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 5.2.2018
     */
    public function update($id, UpdatePayoutReasonRequest $request) {
           $payout_reason = $request->payout_reason;
      $sql=PayoutReason::where([['payout_reason',$payout_reason],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Payout reason has already been taken.']);
      } else { 
        $this->payout_reasons->update($id, $request);
        return redirect()->route('payout_reasons.index');
    }
    }
 
}
