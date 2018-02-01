<?php

namespace App\Repositories\TripCancellationReason;

use App\Models\TripCancellationReason;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\TripCancellationReasonLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TripCancellationReasonCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class TripCancellationReasonRepository implements TripCancellationReasonRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return TripCancellationReason::join('concessions', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllTripCancellationReasons() {
        return TripCancellationReason::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
     
        $input['user_id'] = $userid;
        $input['concession_allowed_on'] = $this->mySqlDate($requestData->concession_allowed_on);
       if($requestData->print_ticket=="Yse")
        {
         $input[print_ticket] = $userid=$requestData->print_ticket;  
        } else {
         $input[print_ticket] = "No";     
        }
        $concession = TripCancellationReason::create($input);
        Session::flash('flash_message', "TripCancellationReason Fare Slab Created Successfully."); //Snippet in Master.blade.php
        return $concession;
       
    }
 public function update($id, $requestData) {
        $this->createLog('App\Models\TripCancellationReason','App\Models\TripCancellationReasonLog',$id);
        $concession = TripCancellationReason::findorFail($id);
         $input = $requestData->all();
        //        print_r($requestData->all());
//        exit();
        $input['concession_allowed_on'] = $this->mySqlDate($requestData->concession_allowed_on);
        $userid = Auth::id();
        $input[user_id] = $userid;
        if($requestData->print_ticket=="Yse")
        {
         $input[print_ticket] = $userid=$requestData->print_ticket;  
        } else {
         $input[print_ticket] = "No";     
        }
         $concession->fill($input)->save();
        Session::flash('flash_message', "TripCancellationReason Fare Slab Updated Successfully.");
        return $concession;
    }

}
