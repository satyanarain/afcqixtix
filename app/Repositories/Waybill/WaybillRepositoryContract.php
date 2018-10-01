<?php
namespace App\Repositories\Waybill;
interface WaybillRepositoryContract
{
    
    public function find($id);
    public function getAllWaybills();
    public function create($requestData);
    public function update($id, $requestData);

}
