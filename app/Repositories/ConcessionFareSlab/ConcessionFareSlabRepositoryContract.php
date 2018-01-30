<?php
namespace App\Repositories\ConcessionFareSlab;
interface ConcessionFareSlabRepositoryContract
{
    public function find($id);
    public function getAllConcessionFareSlabs();
    public function create($requestData);
    public function update($id, $requestData);

}
