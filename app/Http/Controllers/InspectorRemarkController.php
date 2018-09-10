<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\InspectorRemark;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InspectorRemark\UpdateInspectorRemarkRequest;
use App\Http\Requests\InspectorRemark\StoreInspectorRemarkRequest;
use App\Repositories\InspectorRemark\InspectorRemarkRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\checkPermission;
class InspectorRemarkController extends Controller {

    protected $inspector_remarks;
    use checkPermission;
    public function __construct(
    InspectorRemarkRepositoryContract $inspector_remarks
    ) {
        $this->inspector_remarks = $inspector_remarks;
    }

    /**
     * Display a listing of the resource.
     ** @Author created by satya 4.2.2018
     * @return Response
     */
 public function index() {
     if(!$this->checkActionPermission('inspector_remarks','view'))
            return redirect()->route('401');
                $inspector_remarks = DB::table('inspector_remarks')
                ->orderby('inspector_remarks.order_number')       
                ->get();
                return view('inspector_remarks.index',compact('inspector_remarks'));
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
            DB::table('inspector_remarks')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
                $sql = DB::table('inspector_remarks')->select('*')
                   ->orderby('inspector_remarks.order_number')       
                ->get();
        ?>
                <thead>
                    <tr>  
                        <th>Order Number</th>
                        <th>Short Remarks</th>
                        <th>Remarks Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($sql as $value) {
                ?>
                            <tr class="nor_f">
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->short_remark ?></td>
                                <td><?php echo $value->remark_description ?></td>
                                <td><a  href="<?php echo route("inspector_remarks.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" onclick="viewDetails(<?php echo $value->id ?>,'view_detail')"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    public function orderList() {
        
       $sql = DB::table('inspector_remarks')->select('*')
                 ->orderby('inspector_remarks.order_number')       
                ->get();
        ?>
                      
        <?php foreach ($sql as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->short_remark; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->remark_description; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
    
    public function viewDetail($id) {
        if(!$this->checkActionPermission('inspector_remarks','view'))
            return redirect()->route('401');
       $value = DB::table('inspector_remarks')->select('*')
                ->where('inspector_remarks.id',$id) 
               ->orderby('inspector_remarks.order_number') 
                ->first();
       
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-user"></span>&nbsp;Inspector Remarks</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                   
                    <tr>
                        <td><b>Short Remarks</b></td>
                        <td class="table_normal"><?php  echo $value->short_remark; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Remarks Description</b></td>
                        <td class="table_normal"><?php  echo $value->remark_description; ?></span></td>
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
    $inspector_remarks = DB::table('inspector_remarks')->select('*','inspector_remarks.id as id')
                ->leftjoin('services', 'inspector_remarks.service_id', '=', 'services.id')
                ->get();
        return view('inspector_remarks.previous')->withInspectorRemarks($inspector_remarks);
    }

    public function create() {
        if(!$this->checkActionPermission('inspector_remarks','create'))
            return redirect()->route('401');
     return view('inspector_remarks.create');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param InspectorRemark $inspector_remarks
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
     * @param InspectorRemark $inspector_remarks
     * @return Response
     * * @Author created by satya 4.2.2018
     */
    public function store(StoreInspectorRemarkRequest $inspector_remarksRequest) {
        if(!$this->checkActionPermission('inspector_remarks','create'))
            return redirect()->route('401');
        $version_id = $this->getCurrentVersion();
        $inspector_remarksRequest->request->add(['flag'=> 'a','version_id'=>$version_id]);
        $getInsertedId = $this->inspector_remarks->create($inspector_remarksRequest);
        return redirect()->route('inspector_remarks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if(!$this->checkActionPermission('inspector_remarks','view'))
            return redirect()->route('401');
                       $inspector_remarks = DB::table('inspector_remarks')->select('*','inspector_remarks.id as id','trip_cancellation_reason_category_masters.name as trip_cancellation_reason_category_master_id')
                ->leftjoin('users', 'users.id', '=', 'inspector_remarks.user_id')
                ->leftjoin('trip_cancellation_reason_category_masters', 'trip_cancellation_reason_category_masters.id', '=', 'inspector_remarks.trip_cancellation_reason_category_master_id')
                 ->orderby('inspector_remarks.order_number')       
                ->get();
                return view('inspector_remarks.index',compact('inspector_remarks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @Author created by satya 4.2.2018
     * @return Response
     */
    public function edit($id) {
        if(!$this->checkActionPermission('inspector_remarks','edit'))
            return redirect()->route('401');
        $inspector_remarks = InspectorRemark::findOrFail($id);
        return view('inspector_remarks.edit',compact('inspector_remarks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 4.2.2018
     */
    public function update($id, UpdateInspectorRemarkRequest $request) {
        if(!$this->checkActionPermission('inspector_remarks','edit'))
            return redirect()->route('401');
   $inspector_remark = $request->short_remark;
     $sql=inspectorRemark::where([['short_remark',$inspector_remark],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Inspector remark has already been taken.']);
      } else {
        
        $request->request->add(['flag'=> 'u']);
        $this->inspector_remarks->update($id, $request);
        return redirect()->route('inspector_remarks.index');
    }
    }
}
