<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Repositories\Permission\PermissionRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
class PermissionsController extends Controller
{
 protected $permissions;
 public function __construct(PermissionRepositoryContract $permissions) {
        $this->permissions = $permissions;
        //$this->middleware('user.is.admin', ['only' => ['index', 'create', 'destroy']]);
}

    public function index() {
         $users = DB::table('users')->select('*','users.id as id')
                ->leftjoin('permissions','permissions.user_id','users.id')
                ->orderBy('users.id','desc')
               ->get();
          return view('permissions.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permissions = Permission::get(); //Get all permissions
        return view('permissions.create', compact('permissions'));
    }

    public function saveMenuAll(Request $request) {
        $userid = $request->user_id;
        $checkid = Permission::where('user_id', $userid)->first();
        $checkid->user_id;
        $checkid->id;
        if ($checkid->id != '') {
            $permission = Permission::find($checkid->id);
            $permission->users = implode(',', $request->users);
            $permission->permissions = implode(',', $request->permissions);
            $permission->depots = implode(',', $request->depots);;
            $permission->bus_types = implode(',', $request->bus_types);
            $permission->save();
            echo "Menu Updated Successfully!";
            exit();
        } else {
            $input = $request->all();
            $input['users'] = implode(',', $request->users);
            $input['permissions'] = implode(',', $request->permissions);
            $input['depots'] = implode(',', $request->depots);;
            $input['bus_types'] = implode(',', $request->bus_types);
            
            
            Permission::create($input);
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
    public function store(StorePermissionRequest $request) {
        $this->permissions->create($request);
        return redirect()->route('permissions.index')->with('success', 'Permission added successfully');
    }

    public function edit(Permission $permission) {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $permission->name = $request->name;
        $permission->save();
        return redirect()->route('permissions.index')
                        ->with('success', 'Permission' . $permission->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission) {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
    }

}