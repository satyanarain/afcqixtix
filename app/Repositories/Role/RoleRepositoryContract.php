<?php
namespace App\Repositories\Role;

interface RoleRepositoryContract
{
    
    public function listAllRoles();


    public function allRoles();

    public function permissionsUpdate($requestData);

    public function create($requestData);

    public function destroy($id);
}
