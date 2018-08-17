<?php
namespace App\Repositories\Setting;
interface SettingRepositoryContract
{
    
    public function find($id);
    public function getAllSettings();
    public function create($requestData);
    public function update($id, $requestData);

}
