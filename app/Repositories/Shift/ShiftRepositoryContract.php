<?php
namespace App\Repositories\Shift;
interface ShiftRepositoryContract
{
    
    public function find($id);
    public function getAllShifts();
    public function create($requestData);
    public function update($id, $requestData);

}
