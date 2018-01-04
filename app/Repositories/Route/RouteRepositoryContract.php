<?php
namespace App\Repositories\Route;
interface RouteRepositoryContract
{
    
    public function find($id);
    public function getAllRoutes();
    public function create($requestData);
    public function update($id, $requestData);

}
