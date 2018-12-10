<?php
namespace App\Repositories\Inventory\CrewStock;

interface CrewStockRepositoryContract
{
    public function getAllCrewStock();
    public function create($requestData);
    public function update($id, $requestData);
}
