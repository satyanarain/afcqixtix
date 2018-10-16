<?php
namespace App\Repositories\Inventory\DepotStock;

interface DepotStockRepositoryContract
{
    
    //public function find($id);
    public function getAllDepotStock();
    public function create($requestData);
    public function update($id, $requestData);

}
