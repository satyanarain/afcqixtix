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
use App\Traits\checkPermission;
class FaresController extends Controller {

    protected $fares;
    use checkPermission;
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
 public function index($bus_type_id,$service_id,Request $request) {
     if(!$this->checkActionPermission('fares','view'))
            return redirect()->route('401');
     //print_r($request->all());
//     echo $bus_type_id;
//     echo $service_id;
//     echo $bus_type_id = $request->bus_type_id;die;
    $fares = DB::table('fares')->where('service_id', $service_id)->get();
    return view('fares.index',compact('fares','bus_type_id','service_id'));
        //$service = Service::all();
        //return view('fares.index')->withFares($service);
    }

    public function Previous() {
        $fares = DB::table('fare_logs')->select('*', 'fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('fares.previous')->withFares($fares);
    }

    public function create($bus_type_id,$service_id,Request $request) 
    {
        return view('fares.create',compact('bus_type_id','service_id'));
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
    public function store($bus_type_id,$service_id,StoreFareRequest $faresRequest) {
        if(!$this->checkActionPermission('fares','create'))
            return redirect()->route('401');
        $version_id = $this->getCurrentVersion();
        $faresRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
        $faresRequest->request->add(['service_id'=> $service_id]);
        //echo '<pre>';print_r($faresRequest->all());die;
        $bus_type_id = $bus_type_id;
        $service_id = $service_id;
        foreach($faresRequest->stage as $key=>$stage)
        {
            $fare_check = DB::table('fares')->select('id')
                    ->where('service_id','=',$service_id)
                    ->where('stage','=',$stage)
                    ->first();
            if($fare_check){
                Session::flash('message', 'One or more stage fare already exist for selected service.'); 
                Session::flash('alert-class', 'alert-danger'); 
                return view('fares.create',compact('bus_type_id','service_id'));
            }
        }
        foreach($faresRequest->stage as $key=>$stage)
        {
            $data = array();
            $data['stage'] = $stage;
            $data['adult_ticket_amount'] = $faresRequest->adult_ticket_amount[$key];
            $data['child_ticket_amount'] = $faresRequest->child_ticket_amount[$key];
            $data['luggage_ticket_amount'] = $faresRequest->luggage_ticket_amount[$key];
            $data['service_id'] = $service_id;
            $getInsertedId = $this->fares->create($data);
        }
        return redirect()->route('bus_types.services.fares.index',[$bus_type_id,$service_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if(!$this->checkActionPermission('fares','view'))
            return redirect()->route('401');
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
    public function edit($bus_type_id,$service_id,$id) {
        if(!$this->checkActionPermission('fares','edit'))
            return redirect()->route('401');
        //$fares = Fare::findOrFail($id);
        //echo '<pre>';print_r($fares);die;
        $fare_details = DB::table('fares')->where('id',$id)->get();
        //echo '<pre>';print_r($fare_details);die;
        return view('fares.edit',compact('service_id','bus_type_id','fare_details'));
    }
    
    public function fareList($id) {
        $fare_details = DB::table('fares')->where('service_id', $id)->get();
        $maxstage = DB::table('fares')->select(DB::raw('max(stage) as stage'))->where('service_id', $id)->first();
        
        
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
           if(!$this->checkActionPermission('fares','view'))
            return redirect()->route('401');
        //$service = Service::find($id);
        $sql = DB::table('fares')->where('id', $id)->get();
       ?>
       <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header-view" >
        <!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                        <h4 class="viewdetails_details"><span class="fa fa-inr"></span>&nbsp;Fare</h4>
                    </div>
                    <div class="modal-body-view">
                         <table class="table table-responsive.view">
<!--                            <tr>       
                                <td colspan="2"><b>Service Name</b></td>
                                <td class="table_normal"><?php echo $service->name; ?></span></td>
                            </tr>-->
                            <tr> <td colspan="4">
                                            <div class="path-section">
                                                <p class="path-section-heading">Fare Details</p>

                                                <div class="path-section-content">
                                                    <table class="table table-responsive.view">
                                                        <tr>        <td>Stage</td>
                                                            <td>Adult Ticket Amount</td>
                                                            <td>Child Ticket Amount</td>
                                                            <td>Luggage Ticket Amount</td>
                                                        </tr>
                                                        <?php foreach ($sql as $value) { ?>   
                                                            <tr><td class="table_normal"><?php echo $value->stage; ?></td>
                                                                <td class="table_normal"><?php echo $value->adult_ticket_amount; ?></td>
                                                                <td class="table_normal"><?php echo $value->child_ticket_amount; ?></td>
                                                                <td class="table_normal"><?php echo $value->luggage_ticket_amount; ?></td>
                                                            </tr>
                                                        <?php } ?> </table> 
                                                </div>             
                                            </div>             

                                        </td>
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

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($bus_type_id,$service_id,$id, UpdateFareRequest $request) {
        if(!$this->checkActionPermission('fares','edit'))
            return redirect()->route('401');
        //die($id);
        
        $request->request->add(['approval_status'=>'p','flag'=> 'u']);
        $request->request->add(['service_id'=> $service_id]);
        $this->fares->update($id, $request);
        return redirect()->route('bus_types.services.fares.index',[$bus_type_id,$service_id]);
    }
}