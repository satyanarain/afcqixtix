<?php
namespace App\Repositories\CrewDetail;
interface CrewDetailRepositoryContract
{
    
    public function find($id);
    public function getAllCrewDetails();
    public function create($requestData);
    public function update($id, $requestData);

}
