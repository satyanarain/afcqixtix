<?php
namespace App\Repositories\Inventory\CenterStock;
interface CenterStockRepositoryContract
{
    
    //public function find($id);
    public function getAllCenterStock();
    public function create($requestData);
    public function update($id, $requestData);

}
