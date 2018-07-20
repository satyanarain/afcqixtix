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
class DutyController extends Controller {
    use activityLog;
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
    public function index() {

        $duties = DB::table('duties')->select('*','duties.id as id','duties.start_time as start_time','shifts.shift as shift')
                ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'duties.route_id', '=', 'routes.id')
                ->get();
        return view('duties.index')->withDuties($duties);
    }

    public function create() {
        //$duties = Duty::findOrFail();
        return view('duties.create');
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
    public function store(StoreDutyRequest $dutiesRequest) {
    
      $sql=Duty::where([['route_id',$dutiesRequest->route_id],['duty_number',$dutiesRequest->duty_number]])->first();
      if(count($sql)>0)
      {
       return view('duties.create')->withErrors(['This route and duty number has already been taken.']); 
      }else{
       $getInsertedId = $this->duties->create($dutiesRequest);
        return redirect()->route('duties.index');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
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
    public function edit($id) {
        $duties = Duty::findOrFail($id);
        return view('duties.edit')->withDuties($duties);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateDutyRequest $request) {
      $duties = Duty::findOrFail($id);
      $route = $request->route_id;
      $duty_number = $request->duty_number;
      $sql=Duty::where([['route_id',$request->route_id],['duty_number',$request->duty_number],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
      return redirect('duties/'.$id.'/edit')->withErrors(['This route and duty number has already been taken.']);
      } else {
        $this->duties->update($id, $request);
        return redirect()->route('duties.index');
      }
    }

      /**
     * Sort Order.
     * @author
     * @return Response
     */
      public function sortOrder($id) {
        $array = explode(',', $id);
       $k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('duties')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
       $duties = DB::table('duties')->select('*','duties.id as id','duties.start_time as start_time','shifts.shift as shift','duties.order_number as order_number')
                ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'duties.route_id', '=', 'routes.id')
               ->orderBy('duties.order_number')->get();
        ?>
                <thead>
                   <tr>
                            <th>Route</th>
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
                                <td><?php echo $value->route; ?></td>
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->duty_number ?></td>
                                <td><?php echo $value->start_time ?></td>
                                <td><?php echo $value->end_time ?></td>
                                <td><?php echo $value->shift ?></td>
                                
                                <td><a  href="<?php echo route("duties.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" onclick="viewDetails(<?php echo $value->id ?>,'view_detail')"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    
    public function orderList() {
       
           $duties = DB::table('duties')->select('*', 'duties.id as id', 'duties.start_time as start_time', 'shifts.shift as shift', 'duties.order_number as order_number')
                        ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                        ->leftjoin('routes', 'duties.route_id', '=', 'routes.id')
                        ->orderBy('duties.order_number')->get();
        ?>
                      
        <?php foreach ($duties as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->route; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->duty_number; ?></a>
                   
                   </li>
        <?php } ?>
                   
        <?php
    }
   public function viewDetail($id) {
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
