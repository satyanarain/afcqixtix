<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Duty\UpdateDutyRequest;
use App\Http\Requests\Duty\StoreDutyRequest;
use App\Repositories\Duty\DutyRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
use App\Traits\checkPermission;
class DutyController extends Controller {
    use activityLog;
    use checkPermission;
    protected $duties;

    public function __construct(
    DutyRepositoryContract $duties
    ) {
        $this->duties = $duties;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(!$this->checkActionPermission('duties','view'))
            return redirect()->route('401');
        $route_master_id = $request->route_master_id;
        $duties = DB::table('duties')->select('*','duties.id as id','duties.order_number as order_number','duties.end_time as end_time','duties.start_time as start_time','shifts.shift as shift')
                ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                ->leftjoin('route_master', 'duties.route_id', '=', 'route_master.id')
                ->where('duties.route_id',$request->route_master_id)
                ->orderBy('duties.order_number')
                ->get();
        return view('duties.index',compact('duties','route_master_id'));
    }

    public function create(Request $request){
        if(!$this->checkActionPermission('duties','create'))
            return redirect()->route('401');
        $route_master_id = $request->route_master_id;
        //$duties = Duty::findOrFail();
        return view('duties.create', compact('route_master_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Duty $duties
     * @return Response
     */
    public function store($route_master_id,StoreDutyRequest $dutiesRequest) {
        if(!$this->checkActionPermission('duties','create'))
            return redirect()->route('401');
      $sql=Duty::where([['route_id',$dutiesRequest->route_id],['duty_number',$dutiesRequest->duty_number]])->first();
      if(count($sql)>0)
      {
       return view('duties.create')->withErrors(['This route and duty number has already been taken.']); 
      }else{
        $version_id = $this->getCurrentVersion();
        $dutiesRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
        $dutiesRequest->request->add(['route_id'=> $route_master_id]);
        $getInsertedId = $this->duties->create($dutiesRequest);
        return redirect()->route('route_master.duties.index',$route_master_id);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if(!$this->checkActionPermission('duties','view'))
            return redirect()->route('401');
        // $duties=Duty::findOrFail($id);
         $duties = DB::table('duties')->select('*','duties.id as id')
                ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'duties.route_id', '=', 'routes.id')
                 ->where('duties.id','=',$id)
                ->first();
        
       return view('duties.show')->withDuties($duties);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($route_master_id,$id) {
        if(!$this->checkActionPermission('duties','edit'))
            return redirect()->route('401');
        $duties = Duty::findOrFail($id);
        return view('duties.edit',compact('duties','route_master_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($route_master_id,$id, UpdateDutyRequest $request) {
        if(!$this->checkActionPermission('duties','edit'))
            return redirect()->route('401');
      $duties = Duty::findOrFail($id);
      $route = $request->route_id;
      $duty_number = $request->duty_number;
      $sql=Duty::where([['route_id',$request->route_id],['duty_number',$request->duty_number],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
      return redirect('duties/'.$id.'/edit')->withErrors(['This route and duty number has already been taken.']);
      } else {
          
        $request->request->add(['approval_status'=>'p','flag'=> 'u']);
        $this->duties->update($id, $request);
        return redirect()->route('route_master.duties.index',$route_master_id);
      }
    }

      /**
     * Sort Order.
     * @author
     * @return Response
     */
      public function sortOrder($id,$route_master_id) {
        $array = explode(',', $id);
       $k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('duties')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
       $duties = DB::table('duties')->select('*','duties.id as id','duties.start_time as start_time','shifts.shift as shift','duties.order_number as order_number')
                ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                ->leftjoin('route_master', 'duties.route_id', '=', 'route_master.id')
               ->where('duties.route_id',$route_master_id)  
               ->orderBy('duties.order_number')->get();
        ?>
                <thead>
                   <tr>
<!--                            <th>Route</th>-->
                            <th>Order Number</th>
                            <th>Duty Number</th>
                           <th>Start Time</th>
                           <th>End Time</th>
                            <th>Shift</th>
                           <th>Action</th>
                        </tr>
                </thead>
                <tbody>
            <?php foreach ($duties as $value) {
                ?>
                            <tr class="nor_f">
<!--                                <td><?php echo $value->route; ?></td>-->
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->duty_number ?></td>
                                <td><?php echo $value->start_time ?></td>
                                <td><?php echo $value->end_time ?></td>
                                <td><?php echo $value->shift ?></td>
                                
                                <td>
                                    <a href="<?php echo route('route_master.duties.edit',[$route_master_id,$value->id])?>" title="Edit Duty"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a style="cursor: pointer;" title="View Duty" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    
    public function orderList(Request $request) {
       
           $duties = DB::table('duties')->select('*', 'duties.id as id', 'duties.start_time as start_time', 'shifts.shift as shift', 'duties.order_number as order_number')
                        ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                        ->leftjoin('routes', 'duties.route_id', '=', 'routes.id')
                        ->where('duties.route_id',$request->route_id)  
                        ->orderBy('duties.order_number')->get();
        ?>
                      
        <?php foreach ($duties as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                        <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);" ><?php echo $value->route; ?></a>
                    
                    <a href="javascript:void(0);"><?php echo $value->duty_number; ?></a>
                   
                   </li>
        <?php } ?>
                   
        <?php
    }
   public function viewDetail($id) {
       if(!$this->checkActionPermission('duties','view'))
            return redirect()->route('401');
           $value = DB::table('duties')->select('*','duties.id as id','duties.start_time as start_time','shifts.shift as shift','duties.order_number as order_number','duties.created_at as created_at','duties.updated_at as updated_at')
                    ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                    ->leftjoin('routes', 'duties.route_id', '=', 'routes.id')
                    ->leftjoin('users', 'users.id', '=', 'duties.user_id')
                    ->orderBy('duties.order_number')
                    ->where('duties.id',$id)->first();
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;Duty</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Route</b></td>
                        <td class="table_normal"><?php  echo $value->route ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Duty Number</b></td>
                        <td class="table_normal"><?php  echo $value->duty_number; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td class="table_normal"><?php echo $value->order_number; ?></td>
                    </tr>
                    <?php $this->userHistory($value->user_name,$value->created_at,$value->updated_at) ; ?>
                  </table>  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <?php   
    }
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
}
