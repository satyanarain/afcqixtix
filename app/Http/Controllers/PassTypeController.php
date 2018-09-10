<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\PassType;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PassType\UpdatePassTypeRequest;
use App\Http\Requests\PassType\StorePassTypeRequest;
use App\Repositories\PassType\PassTypeRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\checkPermission;
class PassTypeController extends Controller {

    protected $pass_types;
    use checkPermission;
    public function __construct(
    PassTypeRepositoryContract $pass_types
    ) {
        $this->pass_types = $pass_types;
    }

    /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */
 public function index($bus_type_id,$service_id) {
     if(!$this->checkActionPermission('pass_types','view'))
            return redirect()->route('401');
                $pass_types = DB::table('pass_types')
                ->select('*','services.name as name','pass_types.order_number as order_number','pass_types.id as id','concession_provider_masters.name as concession_provider_master_id')
                ->leftjoin('users', 'users.id', '=', 'pass_types.user_id')
                ->leftjoin('services', 'pass_types.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'pass_types.concession_provider_master_id')
                //->leftjoin('pass_type_masters', 'pass_type_masters.id', '=', 'pass_types.pass_type_master_id')
                ->where('service_id', $service_id)
                ->orderby('pass_types.order_number')       
                ->get();
        //echo '<pre>';print_r($pass_types);die;
                 return view('pass_types.index',compact('pass_types','bus_type_id','service_id'));
    }
    
 /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */    
    

    public function orderList(Request $request) {
          $sql = DB::table('pass_types')->select('*','pass_types.order_number as order_number','pass_types.id as id','concession_provider_masters.name as concession_provider_master_id','services.name as servicename')
                ->leftjoin('users', 'users.id', '=', 'pass_types.user_id')
                ->leftjoin('services', 'pass_types.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'pass_types.concession_provider_master_id')
                //->leftjoin('pass_type_masters', 'pass_type_masters.id', '=', 'pass_types.pass_type_master_id')
                ->where('pass_types.service_id',$request->service_id)
                ->orderby('pass_types.order_number')       
                ->get();

            ?>
                      
        <?php foreach ($sql as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->servicename; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->concession_provider_master_id; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
    
    public function viewDetail($id) {
        if(!$this->checkActionPermission('pass_types','view'))
            return redirect()->route('401');
       // die($id);
           $value = DB::table('pass_types')->select('*','pass_types.order_number as order_number','concession_provider_masters.name as concession_provider_master_id','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'pass_types.user_id')
                ->leftjoin('services', 'pass_types.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'pass_types.concession_provider_master_id')
                //->leftjoin('pass_type_masters', 'pass_type_masters.id', '=', 'pass_types.pass_type_master_id')
                ->where('pass_types.id',$id)
                ->orderby('pass_types.order_number')       
                ->first();
        //echo '<pre>';print_r($value);die;
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;Bus Type</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Pass Provider</b></td>
                        <td class="table_normal"><?php  echo $value->concession_provider_master_id ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Pass Type</b></td>
                        <td class="table_normal"><?php  echo $value->type_name; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Description</b></td>
                        <td class="table_normal"><?php echo $value->description; ?></td>
                    </tr>
                    <tr>       
                        <td><b>Short Description</b></td>
                        <td class="table_normal"><?php  echo $value->short_description ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Amount</b></td>
                        <td class="table_normal"><?php  echo $value->amount; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Validity Message</b></td>
                        <td class="table_normal"><?php echo $value->validity_message; ?></td>
                    </tr>
                    <tr>
                        <td><b>Info Message</b></td>
                        <td class="table_normal"><?php echo $value->info_message; ?></td>
                    </tr>
                    <tr>       
                        <td><b>Accept Gender</b></td>
                        <td class="table_normal"><?php  echo $value->accept_gender ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Accept Age</b></td>
                        <td class="table_normal"><?php if($value->accept_age=="Yes"){echo $value->accept_age.' Age between '.$value->accept_age_from.'-'.$value->accept_age_to;}else{echo $value->accept_age;} ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Accept Spouse Age</b></td>
                        <td class="table_normal"><?php if($value->accept_spouse_age=="Yes"){echo $value->accept_spouse_age.' Age between '.$value->accept_spouse_age_from.'-'.$value->accept_spouse_age_to;}else{echo $value->accept_age;} ?></span></td>
                    </tr>
                    <tr>       
                        <td><b>Accept ID Number</b></td>
                        <td class="table_normal"><?php  echo $value->accept_id_number ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td class="table_normal"><?php  echo $value->order_number; ?></span></td>
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
    
    
public function sortOrder($id,$service_id,$bus_type_id){
$array = explode(',', $id);
//echo '<pre>';print_r($array);die;
$k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('pass_types')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
     $sql = DB::table('pass_types')->select('*','services.name as name','pass_types.id as id','pass_types.order_number as order_number','concession_provider_masters.name as concession_provider_master_id')
                ->leftjoin('users', 'users.id', '=', 'pass_types.user_id')
                ->leftjoin('services', 'pass_types.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'pass_types.concession_provider_master_id')
                //->leftjoin('pass_type_masters', 'pass_type_masters.id', '=', 'pass_types.pass_type_master_id')
                ->where('pass_types.service_id',$service_id)
                ->orderby('pass_types.order_number')       
                ->get();
        ?>
                <thead>
                    <tr> 
<!--                        <th>Service Name</th>-->
                        <th>Order Number</th>
                        <th>PassType Provider</th>
                        <th>Pass Type</th>
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
                                <td><?php echo $value->concession_provider_master_id; ?></td>
                                <td><?php echo $value->type_name; ?></td>
                                <td><?php echo $value->description; ?></td>
                                <td>
                                    <a href="<?php echo route('bus_types.services.pass_types.edit',[$bus_type_id,$service_id,$value->id])?>" title="Edit Pass Type"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a style="cursor: pointer;" title="View Pass Type Detail" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    
    
    
 public function Previous() {
    $pass_types = DB::table('fare_logs')->select('*','fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('pass_types.previous')->withPassTypes($pass_types);
    }

    public function create($bus_type_id,$service_id) {
        if(!$this->checkActionPermission('pass_types','create'))
            return redirect()->route('401');
     return view('pass_types.create',compact('bus_type_id','service_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param PassType $pass_types
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
     * @param PassType $pass_types
     * @return Response
     * * @Author created by satya 31-01-2018 
     */
    public function store($bus_type_id,$service_id,StorePassTypeRequest $pass_typesRequest) {
        if(!$this->checkActionPermission('pass_types','create'))
            return redirect()->route('401');
        $version_id = $this->getCurrentVersion();
        $pass_typesRequest->request->add(['flag'=> 'a','version_id'=>$version_id]);
        $pass_typesRequest->request->add(['service_id'=> $service_id]);
        $getInsertedId = $this->pass_types->create($pass_typesRequest);
        return redirect()->route('bus_types.services.pass_types.index',[$bus_type_id,$service_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if(!$this->checkActionPermission('pass_types','view'))
            return redirect()->route('401');
                $pass_types = DB::table('pass_types')->select('*','pass_types.id as id','users.name as username','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'pass_types.user_id')
                ->leftjoin('services', 'pass_types.service_id', '=', 'services.id')
                ->get();
                 return view('pass_types.index')->withPassTypes($pass_types);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @Author created by satya 31-01-2018 
     * @return Response
     */
    public function edit($bus_type_id,$service_id,$id) {
        if(!$this->checkActionPermission('pass_types','edit'))
            return redirect()->route('401');
        $pass_types = PassType::findOrFail($id);
        return view('pass_types.edit',compact('pass_types','service_id','bus_type_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 31-01-2018 
     */
    public function update($bus_type_id,$service_id,$id, UpdatePassTypeRequest $request) {
        if(!$this->checkActionPermission('pass_types','edit'))
            return redirect()->route('401');
        
        $request->request->add(['flag'=> 'u']);
        $this->pass_types->update($id, $request);
        return redirect()->route('bus_types.services.pass_types.index',[$bus_type_id,$service_id]);
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
