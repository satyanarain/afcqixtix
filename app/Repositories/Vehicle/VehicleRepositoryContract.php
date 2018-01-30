<?php
namespace App\Repositories\Vehicle;
interface VehicleRepositoryContract
{
    public function find($id);
    public function getAllVehicles();
    public function create($requestData);
    public function update($id, $requestData);

}
