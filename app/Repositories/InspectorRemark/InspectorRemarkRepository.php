<?php

namespace App\Repositories\InspectorRemark;

use App\Models\InspectorRemark;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\InspectorRemarkLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InspectorRemarkCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class InspectorRemarkRepository implements InspectorRemarkRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return InspectorRemark::join('inspector_remarks', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllInspectorRemarks() {
        return InspectorRemark::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $concession = InspectorRemark::create($input);
        Session::flash('flash_message', "Inspactor Remark Created Successfully."); //Snippet in Master.blade.php
        return $concession;
       
    }
 public function update($id, $requestData) {
         //$this->createLog('App\Models\InspectorRemark','App\Models\InspectorRemarkLog',$id);
         $concession = InspectorRemark::findorFail($id);
         $input = $requestData->all();
         $userid = Auth::id();
         $input[user_id] = $userid;
         $concession->fill($input)->save();
         Session::flash('flash_message', "Inspactor Remark Updated Successfully.");
        return $concession;
    }
}
