<?php

namespace App\Repositories\Denomination;

use App\Models\Denomination;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\DenominationLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DenominationCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class DenominationRepository implements DenominationRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return Denomination::join('concessions', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllDenominations() {
        return Denomination::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $concession = Denomination::create($input);
        Session::flash('flash_message', "Trip Cancellation Reason created Successfully."); //Snippet in Master.blade.php
        return $concession;
       
    }
 public function update($id, $requestData) {
         $this->createLog('App\Models\Denomination','App\Models\DenominationLog',$id);
         $concession = Denomination::findorFail($id);
         $input = $requestData->all();
         $userid = Auth::id();
         $input[user_id] = $userid;
         $concession->fill($input)->save();
         Session::flash('flash_message', "Trip Cancellation Reason Updated Successfully.");
        return $concession;
    }

    
    
    
    
    
    
}
