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

class PermissionsController extends Controller
{
    protected  $permissions;


    public function __construct(PermissionRepositoryContract $permissions)
        {
        $this->permissions = $permissions;
            //$this->middleware('user.is.admin', ['only' => ['index', 'create', 'destroy']]);
        }
        
        
        
        public function index()
        {
            $permissions = Permission::all();
            return view('permissions.index',compact('permissions'));
        }
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $permissions = Permission::get(); //Get all permissions
            return view('permissions.create',compact('permissions'));
        }
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(StorePermissionRequest $request)
        {
            
            $this->permissions->create($request);
//            $this->validate($request, [
//                'name'=>'required|max:40',
//            ]);
//            $permission = new Permission();
//            $permission->name = $request->name;
//            $permission->save();
//            if ($request->permissions <> '') { 
//                foreach ($request->permissions as $key=>$value) {
//                    $role = Permission::find($value); 
//                    $role->permissions()->attach($permission);
//                }
//            }
            return redirect()->route('permissions.index')->with('success','Permission added successfully');
        }
       
        public function edit(Permission $permission)
        {
            return view('permissions.edit', compact('permission'));
        }
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Permission  $permission
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Permission $permission)
        {
            $this->validate($request, [
                'name'=>'required',
            ]);
            $permission->name=$request->name;
            $permission->save();
            return redirect()->route('permissions.index')
                ->with('success',
                 'Permission'. $permission->name.' updated!');
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Permission  $permission
         * @return \Illuminate\Http\Response
         */
        public function destroy(Permission $permission)
        {
            $permission->delete();
            return redirect()->route('permissions.index')
                ->with('success',
                 'Permission deleted successfully!');
        }
    }