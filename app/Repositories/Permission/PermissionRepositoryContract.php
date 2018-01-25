<?php
namespace App\Repositories\Permission;

interface PermissionRepositoryContract
{
    
    public function listAllRoles();

    public function allPermissions();

    public function allRoles();

    public function permissionsUpdate($requestData);

    public function create($requestData);

    public function destroy($id);
}
