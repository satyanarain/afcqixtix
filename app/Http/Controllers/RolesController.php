<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\BusType;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Repositories\Role\RoleRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
use App\Traits\checkPermission;
class RolesController extends Controller
{
    protected $roles;
    use checkPermission;
 public function __construct(RoleRepositoryContract $roles) {
        $this->roles = $roles;
        //$this->middleware('user.is.admin', ['only' => ['index', 'create', 'destroy']]);
}

    public function index() {
       $roles = DB::table('roles')->select('*','roles.id as id')
                ->leftjoin('users','roles.user_id','users.id')
                ->orderBy('roles.id','desc')
               ->get();
     
          return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         $roles = DB::table('roles')->select('*','roles.id as id')
                ->leftjoin('users','roles.user_id','users.id')
                ->orderBy('roles.id','desc')
               ->get();

        return view('roles.create', compact('roles'));
    }

    public function saveMenuAll(Request $request) {
         $userid = $request->user_id;
        $checkid = Role::where('user_id', $userid)->first();
        $checkid->user_id;
        $checkid->id;
        if ($checkid->id != '') {
            $permission = Role::find($checkid->id);
            $permission->users = implode(',', $request->users);
            $permission->changepasswords = implode(',', $request->changepasswords);
            $permission->permissions = implode(',', $request->permissions);
            $permission->depots = implode(',', $request->depots);
            $permission->bus_types = implode(',', $request->bus_types);
            $permission->services = implode(',', $request->services);
            $permission->vehicles = implode(',', $request->vehicles);
            $permission->shifts = implode(',', $request->shifts);
            $permission->stops = implode(',', $request->stops);
            $permission->routes = implode(',', $request->routes);
            $permission->duties = implode(',', $request->duties);
            $permission->targets = implode(',', $request->targets);
            $permission->fares = implode(',', $request->fares);
            $permission->concession_fare_slabs = implode(',', $request->concession_fare_slabs);
            $permission->concessions = implode(',', $request->concessions);
            $permission->trip_cancellation_reasons = implode(',', $request->trip_cancellation_reasons);
            $permission->inspector_remarks = implode(',', $request->inspector_remarks);
            $permission->payout_reasons = implode(',', $request->payout_reasons);
            $permission->denominations = implode(',', $request->denominations);
            $permission->pass_types = implode(',', $request->pass_types);
            $permission->crew = implode(',', $request->crew);
            $permission->etm_details = implode(',', $request->etm_details);
            
            $permission->save();
            echo "Menu Updated Successfully!";
            exit();
        } else {
            $input = $request->all();
            $input['users'] = implode(',', $request->users);
             $input['changepasswords'] = implode(',', $request->changepasswords);
            $input['permissions'] = implode(',', $request->permissions);
            $input['depots'] = implode(',', $request->depots);;
            $input['bus_types'] = implode(',', $request->bus_types);
            $input['services'] = implode(',', $request->services);
            $input['vehicles'] = implode(',', $request->vehicles);
            $input['shifts'] = implode(',', $request->shifts);
            $input['stops'] = implode(',', $request->stops);
            $input['routes'] = implode(',', $request->routes);
            $input['duties'] = implode(',', $request->duties);
            $input['targets'] = implode(',', $request->targets);
            $input['fares'] = implode(',', $request->fares);
            $input['concession_fare_slabs'] = implode(',', $request->concession_fare_slabs);
            $input['concessions'] = implode(',', $request->concessions);
            $input['trip_cancellation_reasons'] = implode(',', $request->trip_cancellation_reasons);
            $input['inspector_remarks'] = implode(',', $request->inspector_remarks);
            $input['payout_reasons'] = implode(',', $request->payout_reasons);
            $input['denominations'] = implode(',', $request->denominations);
            $input['pass_types'] = implode(',', $request->pass_types);
            $input['crew'] = implode(',', $request->crew);
            $permission->etm_details = implode(',', $request->etm_details);
            
            Role::create($input);
            echo "Menu Created Successfully!";
            exit();
        }
    }

    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(StoreRoleRequest $rolesRequest)
    {
        $getInsertedId = $this->roles->create($rolesRequest);
        return redirect()->route('roles.index');         
    }       
  
     public function update($id, UpdateBusTypeRequest $request)
    {
    $bus_type = $request->bus_type;
     $sql=BusType::where([['bus_type',$bus_type],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Bus type has already been taken.']);
      } else { 
        
        $this->bustypes->update($id, $request);
        return redirect()->route('bus_types.index');
    }
    }
    
    
    
    

    public function edit(Role $permission) {
        return view('roles.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $permission
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $permission) {
        $permission->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }

}