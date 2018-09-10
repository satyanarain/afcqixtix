<?php

namespace App\Repositories\Duty;

use App\Models\Duty;
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
use App\Mail\DutyCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class DutyRepository implements DutyRepositoryContract {
   use FormatDates;
   use activityLog;
   
    public function find($id) {
        return Duty::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllDutys() {
        return Duty::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $duties = Duty::create($input);
        Session::flash('flash_message', "Duty Created Successfully."); //Snippet in Master.blade.php
        return $duties;
    }

    public function update($id, $requestData) {
        //$this->createLog('App\Models\Duty','App\Models\DutyLog',$id);
        $duties = Duty::findorFail($id);
        $input = $requestData->all();
        $userid = Auth::id();
        $input[user_id] = $userid;
        $duties->fill($input)->save();
        Session::flash('flash_message', "Duty Updated Successfully.");
        return $duties;
    }

}
