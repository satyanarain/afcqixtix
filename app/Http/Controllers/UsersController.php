<?php
namespace App\Http\Controllers;

use Gate;
use Carbon;
use Datatables;
use Notifynder;
use DB;
use Excel;
use Schema;
use Response;
use App\Models\User;
use App\Models\Country;
use App\Models\Permission;
use App\Models\PermissionDetail;
use App\Http\Requests;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPZen\LaravelRbac\Traits\Rbac;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
//use App\Repositories\Setting\SettingRepositoryContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use App\Traits\activityLog;
use App\Traits\checkPermission;
class UsersController extends Controller
{
    use activityLog;
    use checkPermission;
    protected $users;
    protected $roles;
   // protected $settings;
    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles
       // SettingRepositoryContract $settings
    ) {
        $this->users = $users;
        $this->roles = $roles;
      //  $this->settings = $settings;
      
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('users','view'))
            return redirect()->route('401');
        
        $user = DB::table('users')->select('*','users.id as id')
                ->leftjoin('permission_details','permission_details.user_id','users.id')
                ->leftjoin('permissions','permission_details.role_id','permissions.id')
                ->where('permission_details.role_id','!=',1)
                ->orderBy('users.id','desc')->get();
        return view('users.index')->withUsers($user);
   
    }
    public function create()
    {
        if(!$this->checkActionPermission('users','create'))
            return redirect()->route('401');
        $user = User::findOrFail(Auth::id());
        return view('users.create')->withRoles($roles)->withCountries(Country::orderBy('country_name', 'asc')->pluck('country_name', 'id'));
    }


    public function changeProfileImage(Request $request){
        $data = $request->image; 
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $file_name = str_random(40).'.jpeg';
        $folder_path = public_path().'/images/Media/'.$file_name;
        file_put_contents($folder_path, $data);
        $user = User::find($request->id);
        $user->image_path = $file_name;
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Profile picture changed successfully!'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param User $user
     * @return Response
     */
    public function store(StoreUserRequest $userRequest)
    {
        if(!$this->checkActionPermission('users','create'))
            return redirect()->route('401');
        $getInsertedId = $this->users->create($userRequest);
        return redirect()->route('users.index');         
    }
    public function statusUpdate($id)
    {
    $sql=DB::table('users')->where('id',$id)->first(); 
     if($sql->status==0)
       {
       $status=  $sql->status;
       $user = User::findorFail($id);
       $user->status=1;
       $user->save();
       echo 1;
      }else
       {
       $status=  $sql->status;
       $user = User::findorFail($id);
       $user->status=0;
       $user->save();
       echo 0;
       }
    }
    

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
       $value = DB::table('users')->select('*', 'users.id as id')
                        ->leftjoin('permission_details', 'permission_details.user_id', 'users.id')
                        ->leftjoin('permissions', 'permission_details.role_id', 'permissions.id')
                        ->where('users.id', $id)->first();
        return view('users.show')->withValue($value);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('users','edit'))
            return redirect()->route('401');
        $user=DB::table('users')->select('*','users.id as id')->leftjoin('permission_details','permission_details.user_id','users.id')->where('users.id',$id)->first();
        $permissions=DB::table('users')->select('*','users.id as id')->leftjoin('permission_details','permission_details.user_id','users.id')->where('users.id',$id)->first();
        return view('users.edit',compact('permissions'))->withUser($user);
    }

    public function resetPermission($id,$role)
    {
        //echo $id;echo $role;die;
        $data = DB::table('permissions')
                ->select('*')
                ->where('id', $role)->first();
        //echo '<pre>';print_r($data);die;
        foreach($data as $key=>$row)
        {
            //echo $key.' '.$row.'<br>';
            if($key=="id" || $key=="user_id" || $key=="role" || $key=="description" || $key=="created_at" || $key=="updated_at"){
                continue;
            }else{
                $query = DB::table('permission_details')
                        ->where('user_id', '=', $id)
                        ->update([$key => $row]);
            }
        }
        return;
        echo '<pre>';print_r($data);
        echo $id;echo $role;die;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $requestData)
    {
        if(!$this->checkActionPermission('users','edit'))
            return redirect()->route('401');
        //echo '<pre>';        print_r($requestData->all());die;
        
           
        $permission = PermissionDetail::where('user_id',$id);
        $user_id=  Auth::id();
        $input = $requestData->all();
        //echo '<pre>';print_r($input);die;
        $created_by=  Auth::id();
        //$input['user_id'] = $userid;
        $role_id = $requestData->role_id;
        $created_by = $created_by;
        $users = implode(',', $requestData->users);
        $changepasswords = implode(',', $requestData->changepasswords);
        $permissions = implode(',', $requestData->permissions);
        $depots = implode(',', $requestData->depots);
        $bus_types = implode(',', $requestData->bus_types);
        $services = implode(',', $requestData->services);
        $vehicles = implode(',', $requestData->vehicles);
        $shifts = implode(',', $requestData->shifts);
        $stops = implode(',', $requestData->stops);
        $routes = implode(',', $requestData->routes);
        $duties = implode(',', $requestData->duties);
        $targets = implode(',', $requestData->targets);
        $trips = implode(',', $requestData->trips);
        $fares = implode(',', $requestData->fares);
        $concession_fare_slabs = implode(',', $requestData->concession_fare_slabs);
        $concessions = implode(',', $requestData->concessions);
        $trip_cancellation_reasons = implode(',', $requestData->trip_cancellation_reasons);
        $inspector_remarks = implode(',', $requestData->inspector_remarks);
        $payout_reasons = implode(',', $requestData->payout_reasons);
        $denominations = implode(',', $requestData->denominations);
        $pass_types = implode(',', $requestData->pass_types);
        $crews = implode(',', $requestData->crews);
        $ETM_details = implode(',', $requestData->ETM_details);
        $versions = implode(',', $requestData->versions);
        $settings = implode(',', $requestData->settings);
           PermissionDetail::where('user_id',$id)->update(['role_id' => $requestData->role_id,'created_by'=>$created_by,'users'=>$users,'changepasswords'=>$changepasswords,'permissions'=>$permissions,'depots'=>$depots,'bus_types'=>$bus_types,'services'=>$services,'vehicles'=>$vehicles
            ,'shifts'=>$shifts,'stops'=>$stops,'routes'=>$routes,'duties'=>$duties,'targets'=>$targets,'trips'=>$trips,'fares'=>$fares,'concession_fare_slabs'=>$concession_fare_slabs,'concessions'=>$concessions,'trip_cancellation_reasons'=>$trip_cancellation_reasons
           ,'inspector_remarks'=>$inspector_remarks,'payout_reasons'=>$payout_reasons,'denominations'=>$denominations,'pass_types'=>$pass_types,'crews'=>$crews,'ETM_details'=>$ETM_details,'versions'=>$versions,'settings'=>$settings]);     
           //  $permission->fill($input)->save();
      
       $user = User::findorFail($id);
        $input = $requestData->all();
        $date_of_birth = $requestData->date_of_birth;
        if ($date_of_birth != '') {
            $input['date_of_birth'] = date('Y-m-d', strtotime($date_of_birth));
        } else {
            $input['date_of_birth'] ='';
        }
         $companyname = "photo";
        if ($requestData->hasFile('image_path')) {
            if (!is_dir(public_path() . '/images/' . $companyname)) {
                mkdir(public_path() . '/images/' . $companyname, 0777, true);
            }
           // $settings = Settings::findOrFail(1);
            $file = $requestData->file('image_path');
            $destinationPath = public_path() . '/images/' . $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $input['image_path'] = $filename;
        }
         $user->fill($input)->save();
         if($requestData->permission_reset)
            $this->resetPermission($id,$requestData->role_id);
           
        Session::flash('flash_message', "$user->name User Updated Successfully.");

        return redirect()->route('users.index');
    }
    
    
public function roleupdate($id, Request $request)
  {
    $permissions=Permission::where([['id',$id]])->first();
         ?>
            <div class="formmain">
                <div class="plusminusbutton"></div>&nbsp;&nbsp;<?php echo $permissions->role; ?>
            </div>
            <div class="modal-body-view-border">
                <div class="alert-new-success alert-block" id="<?php "message_show".$permissions->id; ?>" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong id="<?php "message".$permissions->id; ?>"></strong>
                </div>
                <table  width="100%" class="table">
                        <tr>
                            <td width="15%">Select All</td>
                            <td width="30%">Menu</td>
                            <td width="55%">Action</td>
                        </tr>
                    </table>
                    <div   class="formmain" onclick="showHide(this.id)" id="ACC1<?php echo $permissions->id; ?>">
                        <div class="plusminusbutton" id="plusminusbuttonACC1<?php echo $permissions->id; ?>">+</div>&nbsp;&nbsp; Master Details
                    </div>

          <div class="row1"  id="formACC1<?php echo $permissions->id; ?>" style="display:none">
                        <div class="row">  
                            <table  align="left" class="table">
                                <?php menuCreate('users','create','edit','view',$permissions->id,$permissions->users); ?>
                                <?php menuCreate('changepasswords','create','edit','view',$permissions->id,$permissions->changepasswords); ?>
                                <?php menuCreate('permissions','create','edit','view',$permissions->id,$permissions->permissions) ; ?>
                                <?php menuCreate('depots','create','edit','view',$permissions->id,$permissions->depots) ; ?>
                                <?php menuCreate('bus_types','create','edit','view',$permissions->id,$permissions->bus_types); ?>
                                <?php menuCreate('services','create','edit','view',$permissions->id,$permissions->services); ?>
                                <?php menuCreate('vehicles','create','edit','view',$permissions->id,$permissions->vehicles); ?>
                                <?php menuCreate('shifts','create','edit','view',$permissions->id,$permissions->shifts); ?>
                                <?php menuCreate('stops','create','edit','view',$permissions->id,$permissions->stops); ?>
                                <?php menuCreate('routes','create','edit','view',$permissions->id,$permissions->routes); ?>
                                <?php menuCreate('duties','create','edit','view',$permissions->id,$permissions->duties); ?>
                                <?php menuCreate('targets','create','edit','view',$permissions->id,$permissions->targets); ?>
                                <?php menuCreate('trips','create','edit','view',$permissions->id,$permissions->trips); ?>
                                <?php menuCreate('fares','create','edit','view',$permissions->id,$permissions->fares); ?>
                                <?php menuCreate('concession_fare_slabs','create','edit','view',$permissions->id,$permissions->concession_fare_slabs); ?>
                                <?php menuCreate('concessions','create','edit','view',$permissions->id,$permissions->concessions); ?>
                                <?php menuCreate('trip_cancellation_reasons','create','edit','view',$permissions->id,$permissions->trip_cancellation_reasons); ?>
                                <?php menuCreate('inspector_remarks','create','edit','view',$permissions->id,$permissions->inspector_remarks); ?>
                                <?php menuCreate('payout_reasons','create','edit','view',$permissions->id,$permissions->payout_reasons); ?>
                                <?php menuCreate('denominations','create','edit','view',$permissions->id,$permissions->denominations); ?>
                                <?php menuCreate('pass_types','create','edit','view',$permissions->id,$permissions->pass_types); ?>
                                <?php menuCreate('crew','create','edit','view',$permissions->id,$permissions->crew); ?>
                               
                            </table> 
                        </div>
                    </div>  
                
                   <div   class="formmain" onclick="showHide(this.id)" id="ACC2<?php echo $permissions->id; ?>">
                        <div class="plusminusbutton" id="plusminusbuttonACC2<?php echo $permissions->id; ?>">+</div>&nbsp;&nbsp;ETM Details
                    </div>
                     <div class="row1"  id="formACC2<?php echo $permissions->id; ?>" style="display:none;">
                        <div class="row">  
                            <table class="table table-responsive.view">
                                 <?php menuCreate('ETM_details','create','edit','view',$permissions->id,$permissions->ETM_details) ?>
                        </table> 
                        </div>
                    </div>
              </div>
      <?php     
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->users->destroy($id);
        
        return redirect()->route('users.index');
    }

    public function createdPassword($token){
        return view('users.activate', ['token' => $token]);
    }
 
    
    
}
