<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Crew;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Crew\UpdateCrewRequest;
use App\Http\Requests\Crew\StoreCrewRequest;
use App\Repositories\Crew\CrewRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\activityLog;
use App\Traits\Ac;
use App\Traits\checkPermission;
//use Illuminate\Support\Facades\Validator;
class CrewController extends Controller
{
    use checkPermission;
    protected $crew;
 
    use activityLog;
    public function __construct(
        CrewRepositoryContract $crew
    ) {
        $this->crew = $crew;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(!$this->checkActionPermission('crews','view'))
            return redirect()->route('401');
        $depot_id = $request->depot_id;
        $crew_details = DB::table('crew')->select('*','crew.id as id')
            ->leftjoin('depots','depots.id','crew.depot_id')
            ->where('crew.depot_id',$request->depot_id)  
            ->orderBy('crew.id','desc')->get();
    return view('crew.index',compact('crew_details','depot_id'))->withCrew($depot);
   
    }
    public function create(Request $request)
    {
        if(!$this->checkActionPermission('crews','create'))
            return redirect()->route('401');
        $depot_id = $request->depot_id;
        //$depot = CrewDetail::findOrFail();
        return view('crew.create',compact('depot_id'));
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
    public function store($depot_id,StoreCrewRequest $depotRequest)
    {
        if(!$this->checkActionPermission('crews','create'))
            return redirect()->route('401');
        $version_id = $this->getCurrentVersion();
        $depotRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
        $depotRequest->request->add(['depot_id'=> $depot_id]);
        //echo '<pre>';print_r($depotRequest);die;
        $getInsertedId = $this->crew->create($depotRequest);
        return redirect()->route('depots.crew.index',$depot_id);       
    }
    /**
     * Display the specified resource.
     *
     * @create by satya  int  $id
     * @date 20-02-2018
     */
   public function show($id)
   {
       if(!$this->checkActionPermission('crews','view'))
            return redirect()->route('401');
   $depot=Crew::findOrFail($id);
    return view('crew.show')->withCrew($depot);
     }

    /**
     * Display the specified resource.
     *
     * @created by satya 
     * @date 20-02-2018
     */
    public function edit($depot_id,$id)
    {
        if(!$this->checkActionPermission('crews','edit'))
            return redirect()->route('401');
       $crew_details = DB::table('crew')->select('*','crew.id as id','depots.id as depot_id')
            ->leftjoin('depots','depots.id','crew.depot_id')
            ->where('crew.id',$id)
            ->orderBy('crew.id','desc')
               ->first();
        return view('crew.edit',compact('crew_details','depot_id'));
    }

    /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    public function update($depot_id,$id, UpdateCrewRequest $request)
    {
        if(!$this->checkActionPermission('crews','edit'))
            return redirect()->route('401');
       $crew_id = $request->crew_id;
      $sql=Crew::where([['crew_id',$crew_id],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['This crew ID has already been taken.']);
      } else {
            
            $request->request->add(['approval_status'=>'p','flag'=> 'u']);
            $this->crew->update($id, $request);
            return redirect()->route('depots.crew.index',$depot_id); 
    }
    }

   /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    
      public function viewDetail($id) {
          if(!$this->checkActionPermission('crews','view'))
            return redirect()->route('401');
           $value = DB::table('crew')->select('*','crew.id as id','depots.id as depot_id','crew.created_at as created_at','crew.updated_at as updated_at')
            ->leftjoin('depots','depots.id','crew.depot_id')
            ->leftjoin('users', 'users.id', '=', 'crew.user_id')
            ->leftjoin('countries','countries.id','crew.country_id')
            ->where('crew.id',$id)
            ->orderBy('crew.id','desc')
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
