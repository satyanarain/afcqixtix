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
use App\Models\CrewDetail;
use App\Models\Country;
use App\Http\Requests;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPZen\LaravelRbac\Traits\Rbac;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CrewDetail\UpdateCrewDetailRequest;
use App\Http\Requests\CrewDetail\StoreCrewDetailRequest;
use App\Repositories\CrewDetail\CrewDetailRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
class CrewDetailController extends Controller
{
    protected $crew_details;
    protected $roles;
    protected $departments;
    protected $settings;
//    public function __construct(
//        CrewDetailRepositoryContract $crew_details,
//        RoleRepositoryContract $roles,
//        SettingRepositoryContract $settings
//    ) {
//        $this->crew_details = $crew_details;
//        $this->roles = $roles;
//        $this->settings = $settings;
//      
//    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $user = DB::table('crew_details')->select('*')->orderBy('id','desc')->get();
    return view('crew_details.index')->withCrewDetails($user);
   
    }
    public function create()
    {
    //  $user = CrewDetail::findOrFail(Auth::id());
     return view('crew_details.create');
    }


    public function changeProfileImage(Request $request){
        $data = $request->image; 
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $file_name = str_random(40).'.jpeg';
        $folder_path = public_path().'/images/Media/'.$file_name;
        file_put_contents($folder_path, $data);
        $user = CrewDetail::find($request->id);
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
     * @param CrewDetail $user
     * @return Response
     */
    public function store(StoreCrewDetailRequest $userRequest)
    {
        $getInsertedId = $this->crew_details->create($userRequest);
        return redirect()->route('crew_details.index');         
    }
    public function statusUpdate($id)
    {
    $sql=DB::table('crew_details')->where('id',$id)->first(); 
    
       if($sql->status==0)
       {
       $status=  $sql->status;
       $user = CrewDetail::findorFail($id);
       $user->status=1;
       $user->save();
       echo "1";
      }else
       {
       $status=  $sql->status;
       $user = CrewDetail::findorFail($id);
       $user->status=0;
       $user->save();
       echo "0";
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
   $user=CrewDetail::findOrFail($id);
    return view('crew_details.show')->withCrewDetail($user);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $user=CrewDetail::findOrFail($id);
      return view('crew_details.edit')->withCrewDetail($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->crew_details->update($id, $request);
        return redirect()->route('crew_details.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->crew_details->destroy($id);
        
        return redirect()->route('crew_details.index');
    }

    public function createdPassword($token){
        return view('crew_details.activate', ['token' => $token]);
    }
 
    
    
}
