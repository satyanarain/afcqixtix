<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Concession;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Concession\UpdateConcessionRequest;
use App\Http\Requests\Concession\StoreConcessionRequest;
use App\Repositories\Concession\ConcessionRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
use App\Traits\checkPermission;
class ConcessionController extends Controller {
    use activityLog;
    use checkPermission;
    protected $concessions;

    public function __construct(
    ConcessionRepositoryContract $concessions
    ) {
        $this->concessions = $concessions;
    }

    /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */
 public function index($bus_type_id,$service_id) {
     if(!$this->checkActionPermission('concessions','view'))
            return redirect()->route('401');
        $concessions = DB::table('concessions')
            ->select('*','concessions.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concessions.order_number as order_number','etm_hot_key_masters.name as etm_hot_key_master_id','concessions.created_at as created_at','concessions.updated_at as updated_at')
            ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
            ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
            ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'concessions.concession_provider_master_id')
            //->leftjoin('concession_masters', 'concession_masters.id', '=', 'concessions.concession_master_id')
            //->leftjoin('pass_type_masters', 'pass_type_masters.id', '=', 'concessions.pass_type_master_id')
            ->leftjoin('etm_hot_key_masters', 'etm_hot_key_masters.id', '=', 'concessions.etm_hot_key_master_id')
            ->where('service_id', $service_id)
            ->orderby('concessions.order_number')       
            ->get();
                
        return view('concessions.index',compact('concessions','bus_type_id','service_id'));
    }
    
 /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */    
    

    public function orderList(Request $request) {
         $concessions = DB::table('concessions')->select('*','concessions.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','concessions.order_number as order_number','etm_hot_key_masters.name as etm_hot_key_master_id','concessions.created_at as created_at','concessions.updated_at as updated_at')
                ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
                ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'concessions.concession_provider_master_id')
                //->leftjoin('concession_masters', 'concession_masters.id', '=', 'concessions.concession_master_id')
                //->leftjoin('pass_type_masters', 'pass_type_masters.id', '=', 'concessions.pass_type_master_id')
                ->leftjoin('etm_hot_key_masters', 'etm_hot_key_masters.id', '=', 'concessions.etm_hot_key_master_id')
                ->where('concessions.service_id',$request->service_id)
                 ->orderby('concessions.order_number')       
                ->get();
        ?>
                      
        <?php foreach ($concessions as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->name; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->concession_provider_master_id; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
    
    public function viewDetail($id) {
        if(!$this->checkActionPermission('concessions','view'))
            return redirect()->route('401');
         $value = DB::table('concessions')->select('*','concessions.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','concessions.order_number as order_number','etm_hot_key_masters.name as etm_hot_key_master_id','concessions.created_at as created_at','concessions.updated_at as updated_at')
                ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
                ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'concessions.concession_provider_master_id')
                //->leftjoin('concession_masters', 'concession_masters.id', '=', 'concessions.concession_master_id')
                //->leftjoin('pass_type_masters', 'pass_type_masters.id', '=', 'concessions.pass_type_master_id')
                ->leftjoin('etm_hot_key_masters', 'etm_hot_key_masters.id', '=', 'concessions.etm_hot_key_master_id')
                ->where('concessions.id',$id)->first();
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-inr"></span>&nbsp;Concession</h4>
            </div>
            <div class="modal-body-view">
                        <table class="table table-responsive.view">
                            <tr>       
                                <td><b>Service</b></td>
                                <td class="table_normal"><?php echo $value->name; ?></span></td>
                            </tr>
                            <tr>
                                <td><b>Concession</b></td>
                                <td class="table_normal"><?php echo $value->concession_provider_master_id ?></td>
                            </tr>
                            <tr>
                                <td><b>Concession Provider</b></td>
                                <td class="table_normal"><?php echo $value->concession_provider_master_id; ?></td>
                            </tr>
                            <tr>
                                <td><b>Description</b></td>
                                <td class="table_normal"><?php echo $value->description; ?></td>
                            </tr>
                            <tr>
                                <td><b>Order Number</b></td>
                                <td class="table_normal"><?php echo $value->order_number; ?></td>
                            </tr>
                            <tr>
                                <td><b>Percentage</b></td>
                                <td class="table_normal"><?php echo $value->percentage; ?></td>
                            </tr>

                            <tr>
                                <td><b>Pass Type</b></td>
                                <td class="table_normal"><?php echo $value->pass_type_master_id; ?></td>
                            </tr>

                            <tr>
                                <td><b>Print Ticket</b></td>
                                <td class="table_normal"><?php echo $value->print_ticket; ?></td>
                            </tr>
                            <tr>
                                <td><b>ETM Hot Key</b></td>
                                <td class="table_normal"><?php echo $this->displayView($value->etm_hot_key_master_id); ?></td>
                            </tr>

                            <tr>
                                <td><b>Concession Allowed on(for all days of the year leave field blank)</b></td>
                                <td class="table_normal"><?php echo $this->displayView($value->concession_allowed_on); ?></td>
                            </tr>
                            <tr>
                                <td><b>Flat Fare</b></td>
                                <td class="table_normal"><?php echo $this->displayView($value->flat_fare); ?></td>
                            </tr>
                            <tr>
                                <td><b>Flat Fare Amount</b></td>
                                <td class="table_normal"><?php echo $this->displayView($value->flat_fare_amount); ?></td>
                            </tr>
                            <tr>
                                <td><b>Created By</b></td>
                                <td class="table_normal"><?php echo  $value->username; ?></td>
                            </tr>
                            <tr>
                                <td><b>Created On</b></td>
                                <td class="table_normal"><?php echo $this->dateView($value->created_at); ?></td>
                            </tr>
                            <tr>
                                <td><b>Last Updated At</b></td>
                                <td class="table_normal"><?php echo $this->dateView($value->updated_at); ?></td>
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
    
    
public function sortOrder($id,$service_id,$bus_type_id) {
    //echo $service_id;echo $bus_type_id;die;
$array = explode(',', $id);
$k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('concessions')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
         $sql = DB::table('concessions')->select('*','concessions.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','concessions.order_number as order_number')
                ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
                ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'concessions.concession_provider_master_id')
                //->leftjoin('concession_masters', 'concession_masters.id', '=', 'concessions.concession_master_id')
                ->where('concessions.service_id',$service_id)
                ->orderby('concessions.order_number')       
                ->get();
        ?>
                <thead>
                    <tr> 
<!--                        <th>Service Name</th>-->
                        <th>Order Number</th>
                        <th>Concession Provider</th>
                        <th>Concession</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($sql as $value) {
                ?>
                            <tr class="nor_f">
<!--                                <td><?php echo $value->name; ?></td>-->
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->concession_provider_master_id ?></td>
                                <td><?php echo $value->con_name ?></td>
                                <td><?php echo $value->description ?></td>
                                <td><a  href="" class="" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a style="cursor: pointer;" title="View Concession Detail" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                           
            <?php } ?>
                </tbody>
        <?php
    }
    
    
    
 public function Previous() {
    $concessions = DB::table('fare_logs')->select('*','fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('concessions.previous')->withConcessions($concessions);
    }

    public function create($bus_type_id,$service_id) {
        if(!$this->checkActionPermission('concessions','create'))
            return redirect()->route('401');
     return view('concessions.create',compact('bus_type_id','service_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Concession $concessions
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
     * @param Concession $concessions
     * @return Response
     * * @Author created by satya 31-01-2018 
     */
    public function store($bus_type_id,$service_id,StoreConcessionRequest $concessionsRequest) {
        if(!$this->checkActionPermission('concessions','create'))
            return redirect()->route('401');
        $concessionsRequest->request->add(['service_id'=> $service_id]);
        $getInsertedId = $this->concessions->create($concessionsRequest);
        return redirect()->route('bus_types.services.concessions.index',[$bus_type_id,$service_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if(!$this->checkActionPermission('concessions','view'))
            return redirect()->route('401');
                $concessions = DB::table('concessions')->select('*','concessions.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','concessions.order_number as order_number')
                ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
                ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'concessions.concession_provider_master_id')
                //->leftjoin('concession_masters', 'concession_masters.id', '=', 'concessions.concession_master_id')
                 ->orderby('concessions.order_number')       
                ->get();
                 return view('concessions.index')->withConcessions($concessions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @Author created by satya 31-01-2018 
     * @return Response
     */
    public function edit($bus_type_id,$service_id,$id) {
        if(!$this->checkActionPermission('concessions','edit'))
            return redirect()->route('401');
        $concessions = Concession::findOrFail($id);
        return view('concessions.edit',compact('concessions','service_id','bus_type_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 31-01-2018 
     */
    public function update($bus_type_id,$service_id,$id, UpdateConcessionRequest $request) {
        if(!$this->checkActionPermission('concessions','edit'))
            return redirect()->route('401');
          $sql=Concession::where([['service_id',$request->service_id],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
        return redirect('concessions/'.$id.'/edit')->withErrors(['This Service has already been taken.']);
      } else {
        
        $this->concessions->update($id, $request);
        return redirect()->route('bus_types.services.concessions.index',[$bus_type_id,$service_id]);
      }
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
