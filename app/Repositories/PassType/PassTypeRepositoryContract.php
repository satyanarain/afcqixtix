<?php
namespace App\Repositories\PassType;
interface PassTypeRepositoryContract
{
    public function find($id);
    public function getAllPassTypes();
    public function create($requestData);
    public function update($id, $requestData);

}
