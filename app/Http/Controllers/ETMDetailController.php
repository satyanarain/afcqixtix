<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\ETMDetail;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ETMDetail\UpdateETMDetailRequest;
use App\Http\Requests\ETMDetail\StoreETMDetailRequest;
use App\Repositories\ETMDetail\ETMDetailRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\activityLog;
use App\Traits\Ac;

//use Illuminate\Support\Facades\Validator;
class ETMDetailController extends Controller
{
    protected $ETM_details;
 
    use activityLog;
    public function __construct(
        ETMDetailRepositoryContract $ETM_details
    ) {
        $this->ETM_details = $ETM_details;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $ETM_details = DB::table('ETM_details')->select('*','ETM_details.id as id','depots.name as name','evm_status_masters.name as evm_status_master_id')
            ->leftjoin('depots','depots.id','ETM_details.depot_id')
            ->leftjoin('evm_status_masters','evm_status_masters.id','ETM_details.evm_status_master_id')
             ->orderBy('ETM_details.id','desc')->get();
    return view('ETM_details.index',compact('ETM_details'))->withETMDetails($depot);
   
    }
    public function create()
    {
     //$depot = ETMDetail::findOrFail();
     return view('ETM_details.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param ETMDetail $depot
     * @return Response
     */
    public function store(StoreETMDetailRequest $depotRequest)
    {
        $getInsertedId = $this->ETM_details->create($depotRequest);
        return redirect()->route('ETM_details.index');         
    }
    /**
     * Display the specified resource.
     *
     * @create by satya  int  $id
     * @date 20-02-2018
     */
   public function show($id)
   {
  $ETM_details = DB::table('ETM_details')->select('*','ETM_details.id as id','depots.name as name','evm_status_masters.name as evm_status_master_id')
            ->leftjoin('depots','depots.id','ETM_details.depot_id')
            ->leftjoin('evm_status_masters','evm_status_masters.id','ETM_details.evm_status_master_id')
            ->where('ETM_details.id',$id)
             ->orderBy('ETM_details.id','desc')
          ->first();
    return view('ETM_details.index',compact('ETM_details'))->withETMDetails($depot);
   
     }

    /**
     * Display the specified resource.
     *
     * @created by satya 
     * @date 20-02-2018
     */
    public function edit($id)
    {
       $ETM_details = DB::table('ETM_details')->select('*','ETM_details.id as id','depots.id as depot_id')
            ->leftjoin('depots','depots.id','ETM_details.depot_id')
            ->where('ETM_details.id',$id)
            ->orderBy('ETM_details.id','desc')
               ->first();
        return view('ETM_details.edit',compact('ETM_details'));
    }

    /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    public function update($id, UpdateETMDetailRequest $request)
    {
       $etm_no = $request->etm_no;
      $sql=ETMDetail::where([['etm_no',$etm_no],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['This ETM no has already been taken.']);
      } else {
       $this->ETM_details->update($id, $request);
        return redirect()->route('ETM_details.index');
    }
    }

   /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    
      public function viewDetail($id) {
       $value = DB::table('ETM_details')->select('*','ETM_details.id as id','depots.name as name','evm_status_masters.name as evm_status_master_id','ETM_details.created_at as created_at','ETM_details.updated_at as updated_at')
            ->leftjoin('depots','depots.id','ETM_details.depot_id')
            ->leftjoin('users', 'users.id', '=', 'ETM_details.user_id')
            ->leftjoin('evm_status_masters','evm_status_masters.id','ETM_details.evm_status_master_id')
            ->where('ETM_details.id',$id)
             ->orderBy('ETM_details.id','desc')
          ->first();
              
             
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-calculator"></span>&nbsp;ETM Details</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Depot</b></td>
                        <td class="table_normal"><?php  echo $value->name ?></span></td>
                    </tr>
                    <tr>
                        <td><b>ETM No.</b></td>
                        <td class="table_normal"><?php  echo $value->etm_no; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Status</b></td>
                        <td class="table_normal"><?php echo $value->evm_status_master_id; ?></td>
                    </tr>
                    <tr>
                        <td><b>SIM No.</b></td>
                        <td class="table_normal"><?php echo $value->sim_no; ?></td>
                    </tr>
                    <tr>
                        <td><b>EMEI No.</b></td>
                        <td class="table_normal"><?php  echo $this->displayView($value->emei_no); ?></td>
                    </tr>
                    <tr>
                        <td><b>Serial No.</b></td>
                        <td class="table_normal"><?php  echo $this->displayView($value->serial_no); ?></td>
                    </tr>
                    <tr>
                        <td><b>Make</b></td>
                        <td class="table_normal"><?php  echo $this->displayView($value->make); ?></td>
                    </tr>
                  
                    <tr>
                        <td><b>Warranty</b></td>
                        <td class="table_normal"><?php echo $this->dateView($value->warranty); ?></td>
                    </tr>
                    <tr>
                        <td><b>Project period (Years)</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->project_period); ?></td>
                    </tr>
                    <tr>
                        <td><b>Remarks</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->remarks); ?></td>
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
