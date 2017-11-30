<?php
namespace App\Repositories\Permission;

use App\Models\Role;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryContract
{

    public function listAllRoles()
    {
        return Role::pluck('display_name', 'id');
    }

    public function allPermissions()
    {
        return Permissions::all();
    }

    public function allRoles()
    {
        return Role::all();
    }

    public function permissionsUpdate($requestData)
    {
        $allowed_permissions = [];

        if ($requestData->input('permissions') != null) {
            foreach ($requestData->input('permissions')
            as $permissionId => $permission) {
                if ($permission === '1') {
                    $allowed_permissions[] = (int)$permissionId;
                }
            }
        } else {
            $allowed_permissions = [];
        }
       
        $role = Role::find($requestData->input('role_id'));

        $role->permissions()->sync($allowed_permissions);
        $role->save();
    }

    public function create($requestData)
    {
     
        $permissionName = $requestData->name;
        $permissionDescription = $requestData->description;
        Permission::create([
            'name' => strtolower($permissionName),
            'display_name' => ucfirst($permissionName),
             'description' => $permissionDescription
             ]);
    }

    public function destroy($id)
    {
        $permission = Permission::findorFail($id);
        if ($permission->id !== 1) {
            $permission->delete();
        } else {
            Session()->flash('flash_message_warning', 'Can not delete Administrator permission');
        }
    }
}
