<?php
namespace App\Repositories\Stop;
interface StopRepositoryContract
{
    
    public function find($id);
    public function getAllStops();
    public function create($requestData);
    public function update($id, $requestData);

}
