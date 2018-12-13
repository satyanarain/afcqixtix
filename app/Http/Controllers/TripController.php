<?php

namespace App\Http\Controllers;

use DB;
use Gate;
use Carbon;
use Schema;
use Response;
use Validator;
use Notifynder;
use App\Models\Trip;
use App\Models\Duty;
use App\Models\Depot;
use App\Models\Ticket;
use App\Http\Requests;
use App\Models\Waybill;
use App\Models\Country;
use App\Models\TripStart;
use App\Models\ETMLoginLog;
use App\Models\RouteMaster;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Repositories\Trip\TripRepositoryContract;

class TripController extends Controller 
{
    protected $trips;
    use checkPermission;

    public function __construct(TripRepositoryContract $tripss) 
    {
        $this->trips = $tripss;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($route_master_id,$duty_id,Request $request) 
    {
       if(!$this->checkActionPermission('trips','view'))
            return redirect()->route('401');
       //die($route_master_id);
            $trips = DB::table('trips')->select('*','trips.id as id')
                ->leftjoin('duties', 'duties.id', '=', 'trips.duty_id')
                ->leftjoin('shifts', 'shifts.id', '=', 'trips.shift_id')
                ->where('trips.route_id','=',$route_master_id)
                ->where('trips.duty_id','=',$duty_id)
                ->get();
        return view('trips.index',compact('trips','route_master_id','duty_id'));
    }

    public function create($route_master_id,$duty_id) 
    {
        if(!$this->checkActionPermission('trips','create'))
            return redirect()->route('401');
        //$trips = Trip::findOrFail();
        return view('trips.create',compact('route_master_id','duty_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Trip $trips
     * @return Response
     */
    public function store($route_master_id,$duty_id,StoreTripRequest $tripsRequest) {
        if(!$this->checkActionPermission('trips','create'))
            return redirect()->route('401');
        $tripsRequest->route;
        $version_id = $this->getCurrentVersion();
        $tripsRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
        $tripsRequest->request->add(['route_id'=> $route_master_id]);
        $tripsRequest->request->add(['duty_id'=> $duty_id]);
        $getInsertedId = $this->trips->create($tripsRequest);
        return redirect()->route('route_master.duties.trips.index',[$route_master_id,$duty_id]);
       // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    
          public function viewDetail($id) {
              if(!$this->checkActionPermission('trips','view'))
            return redirect()->route('401');
           $trips=Trip::find($id);
            $sql = DB::table('trip_details')->where('trip_id',$id)
             ->get();
               
        ?>
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header-view" >
                    <!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                    <h4 class="viewdetails_details"><span class="fa fa-map-marker"></span>&nbsp;Trip</h4>
                </div>
                <div class="modal-body-view">
                    <table class="table table-responsive.view">
                        <tr>       
                            <td colspan="4"><div class="path-section">
                                    <p class="path-section-heading">Trip</p>

                                    <div class="path-section-content">
                                        <table class="table table-responsive.view">
                                            <tr>       
                                                <td colspan="2"><b>Rout</b></td>
                                                <td class="table_normal"><?php displayIdBaseName('routes', $trips->route_id, 'route'); ?></span></td>
                                            </tr>
                                            <tr>       
                                                <td colspan="2"><b>Duty</b></td>
                                                <td class="table_normal"><?php displayIdBaseName('duties', $trips->duty_id, 'duty_number'); ?></span></td>
                                            </tr>

                                            <tr>       
                                                <td colspan="2"><b>Shift</b></td>
                                                <td class="table_normal"><?php displayIdBaseName('shifts', $trips->shift_id, 'shift'); ?></span></td>
                                            </tr>
<!--                                            <tr>       
                                                <td colspan="2"><b>Default Path</b></td>
                                                <td class="table_normal"><?php displayView($trips->default_path); ?></span></td>
                                            </tr>  -->
                                        </table>

                                    </div>
                                </div></td>
                        </tr>
                        <tr>       
                            <td colspan="4"><div class="path-section">
                                    <p class="path-section-heading">Trip Details</p>

                                    <div class="path-section-content">
                                        <table class="table table-responsive.view">

                                            <tr><td>Trip No.</td>
                                                <td>Start Time</td>
                                                <td>Path</td>
                                                <td>Deviated Rout</td>
                                                <td>Deviated Path</td>

                                            </tr>
                                            <?php foreach ($sql as $value) { ?>   
                                                <tr><td class="table_normal"><?php echo $value->trip_no; ?></td>
                                                    <td class="table_normal"><?php echo $value->start_time; ?></td>
                                                    <td class="table_normal"><?php displayPath('deviated_path[]'); ?></td>
                                                    <td class="table_normal"><?php echo $value->deviated_route; ?></td>
                                                    <td class="table_normal"><?php displayPath('deviated_path[]') ?></td>
                                                </tr>
                                            <?php } ?> 
                                        </table>

                                    </div>
                                </div></td>
                        </tr>
                          <tr>       
                            <td colspan="2"><b>Is this via stop of the path</b></td>
                            <td class="table_normal"><?php displayView($trips->is_this_by); ?></span></td>
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
    
    
 public function show($id) {
     if(!$this->checkActionPermission('trips','view'))
            return redirect()->route('401');
 $trips = DB::table('trips')->select('*','trip_details.stop_id','trips.route', 'trips.id', 'stops.stop')
                ->leftjoin('trip_details', 'trip_details.stop_id', '=', 'trips.id')
                ->leftjoin('stops', 'trip_details.stop_id', '=', 'stops.id')
                ->get();
        return view('trips.index')->withTrips($trips);
    }
    
 public function getSubCat($id) {

   $table_name=$_REQUEST['table_name'];
$duties = DB::table($table_name)->select('*')->where('route_id',$id)->get();


 if(count($duties)>0)
 {
    ?>
         <select class="form-control" required="required" id="duty_id" name="duty_id">
             <option value="">Select Duty</option>
             <?php  foreach($duties as $value)
   { ?>
           <option value="<?php echo $value->id; ?>"><?php echo $value->duty_number; ?></option>
   <?php } ?>
         </select>
  <?php } else {

      echo 0;
  }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($route_master_id,$duty_id,$id) {
        if(!$this->checkActionPermission('trips','edit'))
            return redirect()->route('401');
        $trips = Trip::findOrFail($id);
         $trip_details = DB::table('trip_details')->select('*')->where('trip_id', $id)->get();
        return view('trips.edit',compact('trips','trip_details','route_master_id','duty_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($route_master_id,$duty_id,$id, UpdateTripRequest $request) {
        if(!$this->checkActionPermission('trips','edit'))
            return redirect()->route('401');
//      $sql = Trip::where([['route', $request->route], ['direction', $request->direction], ['id', '!=', $id]])->first();
//        if (count($sql) > 0) {
//            return redirect()->back()->withErrors(['This route and direction has already been taken.']);
//        } else {
            $request->request->add(['approval_status'=>'p','flag'=> 'u']);
            $request->request->add(['route_id'=> $route_master_id]);
            $request->request->add(['duty_id'=> $duty_id]);
            $this->trips->update($id, $request);
            return redirect()->route('route_master.duties.trips.index',[$route_master_id,$duty_id]);
       // }
    }

    /**
     * Get the tripsheet details.
     *
     * @return Response
     */

    public function tripSheet()
    {
        $depots = Depot::all(['id', 'name']);
        $trips = TripStart::with('fromStop:id,short_name')
                    ->with('toStop:id,short_name')
                    ->get();
        $routes = RouteMaster::all(['id', 'route_name']);
        $duties = Duty::all(['id', 'duty_number']);

        //return response()->json($trips);
        return view('trips.tripsheet', compact('depots', 'trips', 'routes', 'duties'));
    }


    /**
     * Get the trips by route and duty.
     *
     * @return Response
     */
    public function getTripsByRouteAndDuty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'route' => 'required',
            'duty' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'data'=>$validator->fails()]);
        }

        if($request->from_date)
        {
            $from_date = date('Y-m-d H:i', strtotime($request->from_date));
        }else{
            $from_date = date('Y-m-d 00:00');
        }

        if($request->to_date)
        {
            $to_date = date('Y-m-d H:i', strtotime($request->to_date));
        }else{
            $to_date = date('Y-m-d H:i');
        }       
        

        $waybills = Waybill::where([['route_id', $request->route], ['duty_id', $request->duty]])
                    ->whereBetween(DB::raw('DATE(created_at)'), array($from_date, $to_date))
                    ->get()
                    ->pluck('abstract_no');

        if($waybills)
        {            
            $logins = ETMLoginLog::with('conductor:id,crew_name,crew_id')
                        ->whereIN('abstract_no', $waybills)
                        ->get(['id', 'abstract_no', 'conductor_id', 'login_timestamp']);
            
        }else{
            $logins = [];
        }

        return response()->json(['status'=>'Ok', 'data'=>$logins]);
    }

    public function getTicketsByParams(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'trip' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'data'=>$validator->fails()]);
        }

        $tickets = Ticket::with(['fromStop:id,short_name', 'toStop:id,short_name'])
                        ->where('trip_id', $request->trip);
                        ->orderBy('id', 'desc')
                        ->limit(10)
                        ->get(['trip_id', 'ticket_number', 'sold_at', 'adults', 'childs', 'total_amt', 'stage_to', 'stage_from']);

        return response()->json(['status'=>'Ok', 'data'=>$tickets]);
    }


    public function getDutiesByRoute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'route' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'data'=>$validator->fails()]);
        }

        $duties = Duty::where('route_id', $request->route)->get(['id', 'duty_number']);

        return response()->json(['status'=>'Ok', 'data'=>$duties]);
    }

    public function getTripsByLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logins' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'data'=>$validator->fails()]);
        }

        $log = ETMLoginLog::whereId($request->logins)->first();

        if($log)
        {
            $trips = TripStart::with('fromStop:id,short_name')
                    ->with('toStop:id,short_name')
                    ->where('abstract_no', $log->abstract_no)
                    ->get();
        }else {
            $trips = [];
        }

        return response()->json(['status'=>'Ok', 'data'=>$trips]);
    }
}
