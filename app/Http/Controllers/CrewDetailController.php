<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\CrewDetail;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CrewDetail\UpdateCrewDetailRequest;
use App\Http\Requests\CrewDetail\StoreCrewDetailRequest;
use App\Repositories\CrewDetail\CrewDetailRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\activityLog;
use App\Traits\Ac;

//use Illuminate\Support\Facades\Validator;
class CrewDetailController extends Controller
{
    protected $crew_details;
 
    use activityLog;
    public function __construct(
        CrewDetailRepositoryContract $crew_details
    ) {
        $this->crew_details = $crew_details;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $crew_details = DB::table('crew_details')->select('*','crew_details.id as id')
            ->leftjoin('depots','depots.id','crew_details.depot_id')
            ->orderBy('crew_details.id','desc')->get();
    return view('crew_details.index',compact('crew_details'))->withCrewDetails($depot);
   
    }
    public function create()
    {
     //$depot = CrewDetail::findOrFail();
     return view('crew_details.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param CrewDetail $depot
     * @return Response
     */
    public function store(StoreCrewDetailRequest $depotRequest)
    {
        $getInsertedId = $this->crew_details->create($depotRequest);
        return redirect()->route('crew_details.index');         
    }
    /**
     * Display the specified resource.
     *
     * @create by satya  int  $id
     * @date 20-02-2018
     */
   public function show($id)
   {
   $depot=CrewDetail::findOrFail($id);
    return view('crew_details.show')->withCrewDetail($depot);
     }

    /**
     * Display the specified resource.
     *
     * @created by satya 
     * @date 20-02-2018
     */
    public function edit($id)
    {
       $crew_details = DB::table('crew_details')->select('*','crew_details.id as id','depots.id as depot_id')
            ->leftjoin('depots','depots.id','crew_details.depot_id')
            ->where('crew_details.id',$id)
            ->orderBy('crew_details.id','desc')
               ->first();
        return view('crew_details.edit',compact('crew_details'));
    }

    /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    public function update($id, UpdateCrewDetailRequest $request)
    {
       $crew_id = $request->crew_id;
      $sql=CrewDetail::where([['crew_id',$crew_id],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['This crew ID has already been taken.']);
      } else {
       $this->crew_details->update($id, $request);
        return redirect()->route('crew_details.index');
    }
    }

   /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    
      public function viewDetail($id) {
           $value = DB::table('crew_details')->select('*','crew_details.id as id','depots.id as depot_id','crew_details.created_at as created_at','crew_details.updated_at as updated_at')
            ->leftjoin('depots','depots.id','crew_details.depot_id')
                      ->leftjoin('users', 'users.id', '=', 'crew_details.user_id')
            ->leftjoin('countries','countries.id','crew_details.country_id')
            ->where('crew_details.id',$id)
            ->orderBy('crew_details.id','desc')
               ->first();
          
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-user"></span>&nbsp;Crew Details</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Depot</b></td>
                        <td class="table_normal"><?php  echo $value->name ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Role</b></td>
                        <td class="table_normal"><?php  echo $value->role; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Crew Name</b></td>
                        <td class="table_normal"><?php echo $value->crew_name; ?></td>
                    </tr>
                    <tr>
                        <td><b>Crew ID</b></td>
                        <td class="table_normal"><?php echo $value->crew_id; ?></td>
                    </tr>
                    <tr>
                        <td><b>Gender</b></td>
                        <td class="table_normal"><?php  echo $this->displayView($value->gender); ?></td>
                    </tr>
                    <tr>
                        <td><b>Father Name</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->father_name); ?></td>
                    </tr>
                    <tr>
                        <td><b>Licence No.</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->licence_no); ?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Licence No. Valid Up To</b></td>
                        <td class="table_normal"><?php echo $this->dateView($value->valid_up_to); ?></td>
                    </tr>
                    <tr>
                        <td><b>PF. No</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->pf_no); ?></td>
                    </tr>
                    <tr>
                        <td><b>city</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->city); ?></td>
                    </tr>
                    <tr>
                        <td><b>Country</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->country_name); ?></td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->address); ?></td>
                    </tr>
                    <tr>
                        <td><b>Mobile</b></td>
                        <td class="table_normal"><?php echo $this->displayView($value->mobile); ?></td>
                    </tr>
                     <tr>
                        <td><b>Date of Birth</b></td>
                        <td class="table_normal"><?php echo $this->dateView($value->valid_up_to); ?></td>
                    </tr>
                    
                     <tr>
                        <td><b>Date of Join</b></td>
                        <td class="table_normal"><?php echo $this->dateView($value->date_of_join); ?></td>
                    </tr>
                     <tr>
                        <td><b>Date of Leaving</b></td>
                        <td class="table_normal"><?php echo $this->dateView($value->date_of_leaving); ?></td>
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
