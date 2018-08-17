<?php
namespace App\Repositories\User;

interface UserRepositoryContract
{
    
    public function find($id);
    
    public function getAllUsers();

    public function create($requestData);

    public function update($id, $requestData);

    public function destroy($id);
}
