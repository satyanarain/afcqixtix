<?php
namespace App\Repositories\RouteMaster;
interface RouteMasterRepositoryContract
{
    public function find($id);
    public function getAllRoutes();
    public function create($requestData);
    public function update($id, $requestData);

}
