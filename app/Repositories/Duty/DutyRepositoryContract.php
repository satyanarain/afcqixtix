<?php
namespace App\Repositories\Duty;
interface DutyRepositoryContract
{
    
    public function find($id);
    public function getAllDutys();
    public function create($requestData);
    public function update($id, $requestData);

}
