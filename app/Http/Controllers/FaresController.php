<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Fare;
use App\Models\FareDetail;
use App\Models\Service;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fare\UpdateFareRequest;
use App\Http\Requests\Fare\StoreFareRequest;
use App\Repositories\Fare\FareRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FaresController extends Controller {

    protected $fares;

    public function __construct(
    FareRepositoryContract $fares
    ) {
        $this->fares = $fares;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
 public function index() {
  $fares = DB::table('fares')->select('*','fares.id as id','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'fares.user_id')
                ->leftjoin('services', 'fares.service_id', '=', 'services.id')
               ->get();
     return view('fares.index')->withFares($fares);
    }
 public function Previous() {
    $fares = DB::table('fare_logs')->select('*','fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('fares.previous')->withFares($fares);
    }

    public function create() {
     return view('fares.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Fare $fares
     * @return Response
     */
    public function store(StoreFareRequest $faresRequest) {
        $getInsertedId = $this->fares->create($faresRequest);
        return redirect()->route('fares.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
                 $fares = DB::table('fares')->select('*','fares.id as id')
                ->leftjoin('shifts', 'fares.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'fares.route_id', '=', 'routes.id')
                 ->where('fares.id','=',$id)
                ->first();
        
       return view('fares.show')->withFares($fares);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
          $fares = Fare::findOrFail($id);
         $service_id= $fares->service_id;
         $fare_details = DB::table('fare_details')->where('service_id',$service_id)->get();
         return view('fares.edit',compact('fare_details'))->withFares($fares);
    }
    
    public function fareList($id) {
        $fare_details = DB::table('fare_details')->where('service_id', $id)->get();
        $maxstage = DB::table('fare_details')->select(DB::raw('max(stage) as stage'))->where('service_id', $id)->first();
        
        
        if (count($fare_details) > 0) {
            foreach ($fare_details as $value) {
                ?>
                                                <div id="<?php echo "div_remove_field".$value->id ?>" style="padding-left:0px;margin-bottom:10px;" class="col-md-12">
                                                    <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="stage[]" class="form-control" placeholder="Stage" required="required" onkeypress="return isNumberKey(event)" value="<?php echo $value->stage; ?>"></div>
                                                    <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="adult_ticket_amount[]" class="form-control" placeholder="Adult Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="<?php echo $value->adult_ticket_amount; ?>"></div>
                                                    <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="child_ticket_amount[]" class="form-control" placeholder="Child Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="<?php echo $value->child_ticket_amount; ?>"></div>
                                                    <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="luggage_ticket_amount[]" class="form-control" placeholder="Luggage Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="<?php echo $value->luggage_ticket_amount; ?>"></div>
                                                    <div><button class="btn btn-danger remove" type="button" id="<?php echo "remove_field".$value->id ?>" onclick="removeFunction(this.id)"><i class="glyphicon glyphicon-remove"></i> Remove</button></div>
                                                </div>
             <?php } ?>
<!--                                    <input  value="<?php //echo $maxstage->stage; ?>" id="maxvalue" type="hidden">-->
                                    <div class="copy show" id="input_fields_wrap_classes">
                                    </div>
              <?php } else { ?>
                                    <div id="control-group" style="padding-left:0px;  margin-bottom:10px;" class="col-md-12" >
                                        <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="stage[]" class="form-control" placeholder="Stage" required="required" onkeypress="return isNumberKey(event)" value="<?php echo $value->stage; ?>"></div>
                                        <div class="col-md-2" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="adult_ticket_amount[]" class="form-control" placeholder="Adult Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="<?php echo $value->adult_ticket_amount; ?>"></div>
                                        <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="child_ticket_amount[]" class="form-control" placeholder="Child Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="<?php echo $value->child_ticket_amount; ?>"></div>
                                        <div class="col-md-3" style="padding-left:0px;  margin-bottom:10px;"><input type="text" name="luggage_ticket_amount[]" class="form-control" placeholder="Luggage Ticket Amount" required="required" onkeypress="return isNumberKey(event)" value="<?php echo $value->luggage_ticket_amount; ?>"></div>
                                    </div> 
                                    <div class="copy show" id="input_fields_wrap_classes">
                                    </div>
            <?php
        }
    }
/**
     * Update the specified resource in storage.
     *
     * @author  int  satya
     * Date 14 February
     */
    
       public function viewDetail($id) {
           $fare=Fare::find($id);
           $id=$fare->service_id;
           $service=Service::find($id);
           $sql = DB::table('fares')
                  ->leftjoin('services','fares.service_id','services.id')
                  ->leftjoin('fare_details','fare_details.service_id','fares.service_id')
                  ->where('fares.service_id',$id)
             ->get();
            Service   
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 class="viewdetails_details"><span class="fa fa-inr"></span>&nbsp;Fare</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td colspan="2"><b>Service Name</b></td>
                        <td class="table_normal"><?php  echo $service->name; ?></span></td>
                    </tr>
                    <tr>        <td>Stage</td>
                                <td>Adult Ticket Amount</td>
                                <td>Child Ticket Amount</td>
                                <td>Luggage Ticket Amount</td>
                          
                         </tr>
                      <?php foreach($sql as $value) { ?>   
                                     <tr><td class="table_normal"><?php echo $value->stage; ?></td>
                                         <td class="table_normal"><?php echo $value->adult_ticket_amount; ?></td>
                                         <td class="table_normal"><?php echo $value->child_ticket_amount; ?></td>
                                         <td class="table_normal"><?php echo $value->luggage_ticket_amount; ?></td>
                                     </tr>
                      <?php } ?> 
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
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateFareRequest $request) {
        $this->fares->update($id, $request);
        return redirect()->route('fares.index');
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
