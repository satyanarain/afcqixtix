<?php
namespace App\Http\Controllers;
use App\Models\Role;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Repositories\Role\RoleRepositoryContract;

class RolesController extends Controller
{
   protected $roles;
   public function __construct(RoleRepositoryContract $roles)
    {
        $this->roles = $roles;
        $this->middleware('user.is.admin', ['only' => ['index', 'create', 'destroy']]);
    }
    public function index()
    {
     $settingmenu ="settingmenu";
     $settingmenuroles = "settingmenuroles";
     return view('roles.index', compact('settingmenu', 'settingmenuroles'))
     ->withRoles($this->roles->allRoles());
    }
    public function create()
    {
        $settingmenu ="settingmenu";
        $settingmenuroles = "settingmenuroles";
        return view('roles.create', compact('settingmenu','settingmenuroles'));
    }
    public function store(StoreRoleRequest $request)
    {
        $this->roles->create($request);
        Session()->flash('flash_message', 'Role created');
        return redirect()->route('roles.index');
    }
    public function destroy($id)
    {
        $this->roles->destroy($id);
        Session()->flash('flash_message', 'Role deleted');
        return redirect()->route('roles.index');
    }
}
