<?php
namespace App\Repositories\Depot;
interface DepotRepositoryContract
{
    
    public function find($id);
    public function getAllDepots();
    public function create($requestData);
    public function update($id, $requestData);

}
