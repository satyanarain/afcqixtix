<?php
namespace App\Repositories\InspectorRemark;
interface InspectorRemarkRepositoryContract
{
    public function find($id);
    public function getAllInspectorRemarks();
    public function create($requestData);
    public function update($id, $requestData);

}
