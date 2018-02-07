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

class PassTypeController extends Controller {

    protected $pass_types;

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
 public function index() {
                $pass_types = DB::table('pass_types')->select('*')
                ->leftjoin('users', 'users.id', '=', 'pass_types.user_id')
                ->leftjoin('services', 'pass_types.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'pass_types.concession_provider_master_id')
                ->leftjoin('pass_type_masters', 'pass_type_masters.id', '=', 'pass_types.pass_type_master_id')
                ->orderby('pass_types.order_number')       
                ->get();
                
                 return view('pass_types.index')->withPassTypes($pass_types);
    }
    
 /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */    
    

    public function orderList() {
        $bustypes = BusType::orderBy('order_number')->get();
        ?>
                      
        <?php foreach ($bustypes as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->bus_type; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->abbreviation; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
    
    public function viewDetail($id) {
          $value = BusType::orderBy('order_number')->where('id',$id)->first();
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;Bus Type</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Bus Type</b></td>
                        <td class="table_normal"><?php  echo $value->bus_type ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Abbreviation</b></td>
                        <td class="table_normal"><?php  echo $value->abbreviation; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td class="table_normal"><?php echo $value->order_number; ?></td>
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
    
    
public function sortOrder($id) {
$array = explode(',', $id);
$k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('pass_types')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
         $sql = DB::table('pass_types')->select('*','pass_types.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','pass_types.order_number as order_number')
                ->leftjoin('users', 'users.id', '=', 'pass_types.user_id')
                ->leftjoin('services', 'pass_types.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'pass_types.concession_provider_master_id')
                ->orderby('pass_types.order_number')       
                ->get();
        ?>
                <thead>
                    <tr>  <th>Service Name</th>
                        <th>Order Number</th>
                        <th>PassType Provider</th>
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
                                <td><a  href="<?php echo route("pass_types.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#<?php echo $value->id ?>"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
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

    public function create() {
     return view('pass_types.create');
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
    public function store(StorePassTypeRequest $pass_typesRequest) {
        $getInsertedId = $this->pass_types->create($pass_typesRequest);
        return redirect()->route('pass_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
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
    public function edit($id) {
        $pass_types = PassType::findOrFail($id);
        return view('pass_types.edit',compact('pass_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 31-01-2018 
     */
    public function update($id, UpdatePassTypeRequest $request) {
        $this->pass_types->update($id, $request);
        return redirect()->route('pass_types.index');
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
