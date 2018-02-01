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

class TripCancellationReasonController extends Controller {

    protected $trip_cancellation_reasons;

    public function __construct(
    TripCancellationReasonRepositoryContract $trip_cancellation_reasons
    ) {
        $this->trip_cancellation_reasons = $trip_cancellation_reasons;
    }

    /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */
 public function index() {
                $trip_cancellation_reasons = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id')
                ->leftjoin('users', 'users.id', '=', 'trip_cancellation_reasons.user_id')
                ->leftjoin('trip_cancellation_reason_category_masters', 'trip_cancellation_reason_category_masters.id', '=', 'trip_cancellation_reasons.trip_cancellation_reason_category_master_id')
                 ->orderby('trip_cancellation_reasons.order_number')       
                ->get();
                return view('trip_cancellation_reasons.index',compact('trip_cancellation_reasons'));
    }
    
 /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */    
    
public function sortOrder($id) {
$array = explode(',', $id);
$k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('trip_cancellation_reasons')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
         $sql = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','trip_cancellation_reasons.order_number as order_number')
                ->leftjoin('users', 'users.id', '=', 'trip_cancellation_reasons.user_id')
                ->leftjoin('services', 'trip_cancellation_reasons.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'trip_cancellation_reasons.concession_provider_master_id')
                ->leftjoin('concession_masters', 'concession_masters.id', '=', 'trip_cancellation_reasons.concession_master_id')
                 ->orderby('trip_cancellation_reasons.order_number')       
                ->get();
        ?>
                <thead>
                    <tr>  <th>Service Name</th>
                        <th>Order Number</th>
                        <th>TripCancellationReason Provider</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($sql as $value) {
                ?>
                            <tr class="nor_f">
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->concession_provider_master_id ?></td>
                                <td><a  href="<?php echo route("trip_cancellation_reasons.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#<?php echo $value->id ?>"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    
    
    
 public function Previous() {
    $trip_cancellation_reasons = DB::table('fare_logs')->select('*','fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('trip_cancellation_reasons.previous')->withTripCancellationReasons($trip_cancellation_reasons);
    }

    public function create() {
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
     * @Author created by satya 31-01-2018  
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
     * * @Author created by satya 31-01-2018 
     */
    public function store(StoreTripCancellationReasonRequest $trip_cancellation_reasonsRequest) {
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
                $trip_cancellation_reasons = DB::table('trip_cancellation_reasons')->select('*','trip_cancellation_reasons.id as id','users.name as username','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'trip_cancellation_reasons.user_id')
                ->leftjoin('services', 'trip_cancellation_reasons.service_id', '=', 'services.id')
                ->get();
                 return view('trip_cancellation_reasons.index')->withTripCancellationReasons($trip_cancellation_reasons);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @Author created by satya 31-01-2018 
     * @return Response
     */
    public function edit($id) {
        $trip_cancellation_reasons = TripCancellationReason::findOrFail($id);
        return view('trip_cancellation_reasons.edit',compact('trip_cancellation_reasons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 31-01-2018 
     */
    public function update($id, UpdateTripCancellationReasonRequest $request) {
        $this->trip_cancellation_reasons->update($id, $request);
        return redirect()->route('trip_cancellation_reasons.index');
    }
    public function getDuty($id) {
        if($id!='')
        {
        $sql = DB::table('duties')->select('*')->where('route_id', '=', $id)->get();
        if(count($sql)>0)
        {
?>
         <label class="required">Duty</label>
        <select class="form-control" name="duty_id">
        <?php
        foreach ($sql as $value) {
        ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->duty_number; ?></option>

        <?php } ?>
               </select> 

        <?php
    }
    }
    }
}
