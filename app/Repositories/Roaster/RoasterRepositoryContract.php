<?php
namespace App\Repositories\Roaster;
interface RoasterRepositoryContract
{
    
    public function find($id);
    public function getAllRoasters();
    public function create($requestData);
    public function update($id, $requestData);

}
