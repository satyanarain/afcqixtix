<?php
namespace App\Repositories\Fare;

interface FareRepositoryContract
{
    
    public function find($id);
    
    public function getAllFares();

    public function create($requestData);

    public function update($id, $requestData);

    public function destroy($id);
}
