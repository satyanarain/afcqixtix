<?php
namespace App\Repositories\Concession;
interface ConcessionRepositoryContract
{
    public function find($id);
    public function getAllConcessions();
    public function create($requestData);
    public function update($id, $requestData);

}
