<?php
namespace App\Repositories\Inventory\ReturnCrewStock;

interface ReturnCrewStockRepositoryContract
{
    public function getAllReturnCrewStock();
    public function create($requestData);
    public function update($id, $requestData);
}
