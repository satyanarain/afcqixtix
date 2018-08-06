<?php
namespace App\Repositories\Crew;
interface CrewRepositoryContract
{
    
    public function find($id);
    public function getAllCrewDetails();
    public function create($requestData);
    public function update($id, $requestData);

}
