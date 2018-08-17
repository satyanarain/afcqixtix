<?php

namespace App\Repositories\Setting;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class SettingRepository implements SettingRepositoryContract {
    use activityLog;
    use FormatDates;
    public function find($id) {
        return Setting::first();
    }

    public function getAllSettings() {
        return Setting::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $user_id=Auth::id();
        $setting = Setting::create($input);
        Session::flash('flash_message', "Setting $depot->id Created Successfully."); //Snippet in Master.blade.php
        return $setting;
    }

    public function update($id, $requestData) {
       
//        /$this->createLog('App\Models\Setting',$id);
        $setting = Setting::findorFail($id);
        $input = $requestData->all();
        $setting_id = $requestData->id;
        $sql_id=Setting::where([['id',$setting_id],['id','!=',$id]])->first();
        $setting->fill($input)->save();
        Session::flash('flash_message', "Setting $setting->id Updated Successfully.");
        return $depot;
    }
}
