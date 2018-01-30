<?php
namespace App\Repositories\Target;
interface TargetRepositoryContract
{
    public function find($id);
    public function getAllTargets();
    public function create($requestData);
    public function update($id, $requestData);

}
