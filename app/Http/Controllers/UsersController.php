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
use App\Repositories\Setting\SettingRepositoryContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
class UsersController extends Controller
{
    protected $users;
    protected $roles;
    protected $departments;
    protected $settings;
    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles,
        SettingRepositoryContract $settings
    ) {
        $this->users = $users;
        $this->roles = $roles;
        $this->settings = $settings;
      
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $user = DB::table('users')->select('*')->orderBy('id','desc')->get();
    return view('users.index')->withUsers($user);
   
    }
    public function create()
    {
     $user = User::findOrFail(Auth::id());
     return view('users.create')->withRoles($roles)->withCountries(Country::orderBy('country_name', 'asc')->pluck('country_name', 'id'));
    }
 public function getCompaniesUserHasAccessIn(){
        $user = User::findOrFail(Auth::id());
        $company_ids = $user->group_company_id;
        $company_ids = explode(',', $company_ids);
        $companies = GroupCompany::whereIn('id', $company_ids)->get();
        return $companies->toJson();
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
        $getInsertedId = $this->users->create($userRequest);
        return redirect()->route('users.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
   $user=User::findOrFail($id);
    return view('users.show')->withUser($user);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $user=User::findOrFail($id);
      return view('users.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->users->update($id, $request);
        return redirect()->route('users.index');
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
