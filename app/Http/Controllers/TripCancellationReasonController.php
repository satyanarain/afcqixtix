<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\TripCancellationReason;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TripCancellationReason\UpdateTripCancellationReasonRequest;
use App\Http\Requests\TripCancellationReason\StoreTripCancellationReasonRequest;
use App\Repositories\TripCancellationReason\TripCancellationReasonRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\checkPermission;
class TripCancellationReasonController extends Controller {
    use checkPermission;
    protected $trip_cancellation_reasons;

    public function __construct(
    TripCancellationReasonRepositoryContract $trip_cancellation_reasons
    ) {
        $this->trip_cancellation_reasons = $trip_cancellation_reasons;
    }

    /**
     * Display a listing of the resource.
     ** @Author created by satya 4.2.2018
     * @return Response
     */
 public function index() {
     if(!$this->checkActionPermission('trip_cancellation_reasons','view'))
            return redirect()->route('401');
                $trip_cancellation_reasons = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id','trip_cancellation_reason_category_masters.name as trip_cancellation_reason_category_master_id')
                ->leftjoin('users', 'users.id', '=', 'trip_cancellation_reasons.user_id')
                ->leftjoin('trip_cancellation_reason_category_masters', 'trip_cancellation_reason_category_masters.id', '=', 'trip_cancellation_reasons.trip_cancellation_reason_category_master_id')
                 ->orderby('trip_cancellation_reasons.order_number')       
                ->get();
                return view('trip_cancellation_reasons.index',compact('trip_cancellation_reasons'));
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
            DB::table('trip_cancellation_reasons')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
                $sql = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id','trip_cancellation_reason_category_masters.name as trip_cancellation_reason_category_master_id')
                ->leftjoin('users', 'users.id', '=', 'trip_cancellation_reasons.user_id')
                ->leftjoin('trip_cancellation_reason_category_masters', 'trip_cancellation_reason_category_masters.id', '=', 'trip_cancellation_reasons.trip_cancellation_reason_category_master_id')
                 ->orderby('trip_cancellation_reasons.order_number')       
                ->get();
        ?>
                <thead>
                    <tr>  <th>Trip Cancellation Reason</th>
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
                              <td><?php echo $value->trip_cancellation_reason_category_master_id; ?></td>
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->short_reason ?></td>
                                <td><?php echo $value->reason_description ?></td>
                                <td><a  href="<?php echo route("trip_cancellation_reasons.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" onclick="viewDetails(<?php echo $value->id ?>,'view_detail')"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    public function orderList() {
        
       $sql = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id','trip_cancellation_reason_category_masters.name as trip_cancellation_reason_category_master_id')
                ->leftjoin('users', 'users.id', '=', 'trip_cancellation_reasons.user_id')
                ->leftjoin('trip_cancellation_reason_category_masters', 'trip_cancellation_reason_category_masters.id', '=', 'trip_cancellation_reasons.trip_cancellation_reason_category_master_id')
                 ->orderby('trip_cancellation_reasons.order_number')       
                ->get();
        ?>
                      
        <?php foreach ($sql as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->trip_cancellation_reason_category_master_id; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->short_reason; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
    
    public function viewDetail($id) {
        if(!$this->checkActionPermission('trip_cancellation_reasons','view'))
            return redirect()->route('401');
       $value = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id','trip_cancellation_reason_category_masters.name as trip_cancellation_reason_category_master_id')
                ->leftjoin('users', 'users.id', '=', 'trip_cancellation_reasons.user_id')
                ->leftjoin('trip_cancellation_reason_category_masters', 'trip_cancellation_reason_category_masters.id', '=', 'trip_cancellation_reasons.trip_cancellation_reason_category_master_id')
                ->where('trip_cancellation_reasons.id',$id) 
               ->orderby('trip_cancellation_reasons.order_number') 
                ->first();
       
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-inr"></span>&nbsp;Trip Cancellation Reason</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Trip Cancellation Reason</b></td>
                        <td class="table_normal"><?php  echo $value->trip_cancellation_reason_category_master_id; ?></span></td>
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
    $trip_cancellation_reasons = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id')
                ->leftjoin('services', 'trip_cancellation_reasons.service_id', '=', 'services.id')
                ->get();
        return view('trip_cancellation_reasons.previous')->withTripCancellationReasons($trip_cancellation_reasons);
    }

    public function create() {
        if(!$this->checkActionPermission('trip_cancellation_reasons','create'))
            return redirect()->route('401');
     return view('trip_cancellation_reasons.create');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param TripCancellationReason $trip_cancellation_reasons
     * @return Response
     * @Author created by satya 4.2.2018 
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param TripCancellationReason $trip_cancellation_reasons
     * @return Response
     * * @Author created by satya 4.2.2018
     */
    public function store(StoreTripCancellationReasonRequest $trip_cancellation_reasonsRequest) {
        if(!$this->checkActionPermission('trip_cancellation_reasons','create'))
            return redirect()->route('401');
        $version_id = $this->getCurrentVersion();
        $trip_cancellation_reasonsRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
        $getInsertedId = $this->trip_cancellation_reasons->create($trip_cancellation_reasonsRequest);
        return redirect()->route('trip_cancellation_reasons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if(!$this->checkActionPermission('trip_cancellation_reasons','view'))
            return redirect()->route('401');
                       $trip_cancellation_reasons = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id','trip_cancellation_reason_category_masters.name as trip_cancellation_reason_category_master_id')
                ->leftjoin('users', 'users.id', '=', 'trip_cancellation_reasons.user_id')
                ->leftjoin('trip_cancellation_reason_category_masters', 'trip_cancellation_reason_category_masters.id', '=', 'trip_cancellation_reasons.trip_cancellation_reason_category_master_id')
                 ->orderby('trip_cancellation_reasons.order_number')       
                ->get();
                return view('trip_cancellation_reasons.index',compact('trip_cancellation_reasons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @Author created by satya 4.2.2018
     * @return Response
     */
    public function edit($id) {
        if(!$this->checkActionPermission('trip_cancellation_reasons','edit'))
            return redirect()->route('401');
        $trip_cancellation_reasons = TripCancellationReason::findOrFail($id);
        return view('trip_cancellation_reasons.edit',compact('trip_cancellation_reasons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 4.2.2018
     */
    public function update($id, UpdateTripCancellationReasonRequest $request) {
        if(!$this->checkActionPermission('trip_cancellation_reasons','edit'))
            return redirect()->route('401');
        $trip_cancellation_reason_category_master_id = $request->trip_cancellation_reason_category_master_id;
     $sql=TripCancellationReason::where([['trip_cancellation_reason_category_master_id',$trip_cancellation_reason_category_master_id],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['This trip cancellation reason has already been taken.']);
      } else {
        $request->request->add(['approval_status'=>'p','flag'=> 'u']);   
          $this->trip_cancellation_reasons->update($id, $request);
        return redirect()->route('trip_cancellation_reasons.index');
    }
    }
}
