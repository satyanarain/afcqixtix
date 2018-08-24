<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Shift;
use App\Models\BusType;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shift\UpdateShiftRequest;
use App\Http\Requests\Shift\StoreShiftRequest;
use App\Repositories\Shift\ShiftRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
use App\Traits\checkPermission;
class ShiftController extends Controller
{
    use activityLog;
    use checkPermission;
    protected $shifts;
    public function __construct(
        ShiftRepositoryContract $shifts
    ) {
        $this->shifts = $shifts;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('shifts','view'))
            return redirect()->route('401');
     $shifts = Shift::all();
     return view('shifts.index')->withShifts($shifts);
    }
    public function create()
    {
        if(!$this->checkActionPermission('shifts','create'))
            return redirect()->route('401');
     //$shifts = Shift::findOrFail();
     return view('shifts.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Shift $shifts
     * @return Response
     */
    public function store(StoreShiftRequest $shiftsRequest)
    {
        if(!$this->checkActionPermission('shifts','create'))
            return redirect()->route('401');
        $getInsertedId = $this->shifts->create($shiftsRequest);
        return redirect()->route('shifts.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
       if(!$this->checkActionPermission('shifts','view'))
            return redirect()->route('401');
 $shifts = DB::table('shifts')->select('*','shifts.updated_at as updated_at','shifts.id as id','shifts.user_id as user_id','users.user_name as user_name')
           ->leftjoin('users', 'users.id', '=', 'shifts.user_id')
         ->get();
    return view('shifts.show')->withShifts($shifts);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('shifts','edit'))
            return redirect()->route('401');
       $shifts=Shift::findOrFail($id);
      return view('shifts.edit')->withShifts($shifts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateShiftRequest $request)
    {
        if(!$this->checkActionPermission('shifts','edit'))
            return redirect()->route('401');
        $this->shifts->update($id, $request);
        return redirect()->route('shifts.index');
    }

    /**
     * Author satya.
     *
     * @param   Date 23-12-2017
     * @return code create for order
     */
 public function sortOrder($id) {
        $array = explode(',', $id);
       $k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('shifts')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
        $shifs = Shift::orderBy('order_number')->get();
        ?>
                <thead>
                    <tr>  <th>Shift</th>
                        <th>Order Number</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($shifs as $value) {
                ?>
                            <tr class="nor_f">
                                <td><?php echo $value->shift ; ?></td>
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->start_time ?></td>
                                <td><?php echo $value->end_time ?></td>
                                <td><a  href="<?php echo route("shifts.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" onclick="viewDetails(<?php echo $value->id ?>,'view_detail')"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    
    public function orderList() {
        $shifts = Shift::orderBy('order_number')->get();
        ?>
                      
        <?php foreach ($shifts as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->shift; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->abbreviation; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
   public function viewDetail($id) {
       if(!$this->checkActionPermission('shifts','view'))
            return redirect()->route('401');
          $value = DB::table('shifts')->select("*",'shifts.created_at','shifts.updated_at','shifts.id as id')
                  ->leftjoin('users','users.id','shifts.user_id')
                  ->orderBy('shifts.order_number')
                  ->where('shifts.id',$id)->first();
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-calendar"></span>&nbsp;Shift</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Shift</b></td>
                        <td class="table_normal"><?php  echo $value->shift ?></span></td>
                    </tr>
                     <tr>
                        <td><b>Abbreviation</b></td>
                        <td class="table_normal"><?php  echo $value->abbreviation; ?></span></td>
                    </tr>
                     <tr>
                        <td><b>Start Time</b></td>
                        <td class="table_normal"><?php  echo $value->start_time; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>End Time</b></td>
                        <td class="table_normal"><?php echo $value->end_time; ?></td>
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
    
    
 }
