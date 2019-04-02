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

    public function getAllSettings() 
    {
        return Setting::all();
    }

    public function create($requestData) 
    {
        $input = $requestData->all();
        $user_id = Auth::id();
        $input['setting_name'] = implode('_', array_map('strtolower', explode(' ', substr($requestData->setting_name, 0, 10))));
        $input['setting_description'] = $requestData->setting_name;
        $input['setting_unit'] = $requestData->setting_unit;
        $input['setting_remarks'] = $requestData->setting_remarks;
        $setting = Setting::create($input);
        Session::flash('flash_message', "Setting $depot->id Created Successfully."); //Snippet in Master.blade.php
        return $setting;
    }

    public function update($id, $requestData) 
    {
        $setting = Setting::findorFail($id);
        $input = $requestData->all();
        $input['setting_description'] = $requestData->setting_name; 
        $input['setting_name'] = $setting->setting_name; 
        $input['setting_unit'] = $requestData->setting_unit;
        $input['setting_remarks'] = $requestData->setting_remarks;
        $setting_id = $requestData->id;
        $sql_id=Setting::where([['id',$setting_id],['id','!=',$id]])->first();
        $setting->fill($input)->save();
        Session::flash('flash_message', "Setting $setting->id Updated Successfully.");
        return $depot;
    }
}
