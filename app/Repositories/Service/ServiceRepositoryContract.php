<?php
namespace App\Repositories\Service;
interface ServiceRepositoryContract
{
    public function find($id);
    public function getAllServices();
    public function create($requestData);
    public function update($id, $requestData);

}
