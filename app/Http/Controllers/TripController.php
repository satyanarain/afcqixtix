<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Trip;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Repositories\Trip\TripRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\checkPermission;
class TripController extends Controller {

    protected $trips;
    use checkPermission;
    public function __construct(
    TripRepositoryContract $tripss
    ) {
        $this->trips = $tripss;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($route_id,$duty_id,Request $request) {
       if(!$this->checkActionPermission('trips','view'))
            return redirect()->route('401');
        $trips = DB::table('trips')->select('*','trips.id as id')
                 ->leftjoin('duties', 'duties.id', '=', 'trips.duty_id')
                 ->leftjoin('shifts', 'shifts.id', '=', 'trips.shift_id')
                 ->get();
        return view('trips.index',compact('trips','route_id','duty_id'));
    }

    public function create($route_id,$duty_id) {
        if(!$this->checkActionPermission('trips','create'))
            return redirect()->route('401');
        //$trips = Trip::findOrFail();
        return view('trips.create',compact('route_id','duty_id'));
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
    public function store($route_id,$duty_id,StoreTripRequest $tripsRequest) {
        if(!$this->checkActionPermission('trips','create'))
            return redirect()->route('401');
        $tripsRequest->route;
        $tripsRequest->request->add(['route_id'=> $route_id]);
        $tripsRequest->request->add(['duty_id'=> $duty_id]);
        $getInsertedId = $this->trips->create($tripsRequest);
        return redirect()->route('routes.duties.trips.index',[$route_id,$duty_id]);
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
    public function edit($route_id,$duty_id,$id) {
        if(!$this->checkActionPermission('trips','edit'))
            return redirect()->route('401');
        $trips = Trip::findOrFail($id);
         $trip_details = DB::table('trip_details')->select('*')->where('trip_id', $id)->get();
        return view('trips.edit',compact('trips','trip_details','route_id','duty_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($route_id,$duty_id,$id, UpdateTripRequest $request) {
        if(!$this->checkActionPermission('trips','edit'))
            return redirect()->route('401');
//      $sql = Trip::where([['route', $request->route], ['direction', $request->direction], ['id', '!=', $id]])->first();
//        if (count($sql) > 0) {
//            return redirect()->back()->withErrors(['This route and direction has already been taken.']);
//        } else {
            $request->request->add(['route_id'=> $route_id]);
            $request->request->add(['duty_id'=> $duty_id]);
            $this->trips->update($id, $request);
            return redirect()->route('routes.duties.trips.index',['route_id','duty_id']);
       // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
}
