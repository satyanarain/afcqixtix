<?php
namespace App\Repositories\Setting;

interface SettingRepositoryContract
{
    
  
    public function updateOverall($requestData);

    public function getSetting();
}
