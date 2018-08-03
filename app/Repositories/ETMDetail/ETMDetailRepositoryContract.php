<?php
namespace App\Repositories\ETMDetail;
interface ETMDetailRepositoryContract
{
    
    public function find($id);
    public function getAllETMDetails();
    public function create($requestData);
    public function update($id, $requestData);

}
