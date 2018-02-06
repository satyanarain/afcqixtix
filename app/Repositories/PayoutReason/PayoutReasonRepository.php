<?php

namespace App\Repositories\PayoutReason;

use App\Models\PayoutReason;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\PayoutReasonLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PayoutReasonCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class PayoutReasonRepository implements PayoutReasonRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return PayoutReason::join('inspector_remarks', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllPayoutReasons() {
        return PayoutReason::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $concession = PayoutReason::create($input);
        Session::flash('flash_message', "Inspactor Remark Created Successfully."); //Snippet in Master.blade.php
        return $concession;
       
    }
 public function update($id, $requestData) {
         $this->createLog('App\Models\PayoutReason','App\Models\PayoutReasonLog',$id);
         $concession = PayoutReason::findorFail($id);
         $input = $requestData->all();
         $userid = Auth::id();
         $input[user_id] = $userid;
         $concession->fill($input)->save();
         Session::flash('flash_message', "Inspactor Remark Updated Successfully.");
        return $concession;
    }
}
