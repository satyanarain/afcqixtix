<?php
namespace App\Repositories\Denomination;
interface DenominationRepositoryContract
{
    public function find($id);
    public function getAllDenominations();
    public function create($requestData);
    public function update($id, $requestData);

}
