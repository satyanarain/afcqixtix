<?php
namespace App\Repositories\BusType;
interface BusTypeRepositoryContract
{
    
    //public function find($id);
    public function getAllBustypes();
    public function create($requestData);
    public function update($id, $requestData);

}
