<?php
namespace App\Repositories\Version;
interface VersionRepositoryContract
{
    
    public function find($id);
    public function getAllVersions();
    public function create($requestData);
    public function update($id, $requestData);

}
