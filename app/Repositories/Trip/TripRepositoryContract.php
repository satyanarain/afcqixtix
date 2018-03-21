<?php
namespace App\Repositories\Trip;
interface TripRepositoryContract
{
    public function find($id);
    public function getAllTrips();
    public function create($requestData);
    public function update($id, $requestData);

}
