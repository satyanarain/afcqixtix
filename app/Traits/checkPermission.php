<?php

namespace App\Traits;
use App\Models\Permission;
use App\Models\PermissionDetail;
use App\Models\Version;
use Illuminate\Support\Facades\Auth;

trait checkPermission {

    function checkActionPermission($module = '',$action='') {
        $user_id = Auth::id();
        $sql = PermissionDetail::where('user_id', '=', $user_id)->first();
        $result = $sql[$module];
        $array_menu= explode(',', $result);
        if(in_array($action,$array_menu))
            return true;
        else
            return false;
    }
    function checkVersionOpen() {
        $user_id = Auth::id();
        $sql = Version::where('version_status', '=', 'o')->first();
        
        if($sql)
            return true;
        else
            return false;
    }
    
    function getCurrentVersion()
    {
        $user_id = Auth::id();
        $sql = Version::where('version_status', '=', 'o')->first();
        
        if($sql)
            return $sql->id;
        else
            return false;
    }
    
    
    function generateUniqueNumber()
    {
        return date('dm').str_pad(random_int(0, 99999999), 6, '0', STR_PAD_LEFT);
    }

}