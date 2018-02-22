<?php

namespace App\Repositories\PassType;

use App\Models\PassType;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\PassTypeLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PassTypeCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class PassTypeRepository implements PassTypeRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return PassType::join('concessions', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllPassTypes() {
        return PassType::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
     
        $input['user_id'] = $userid;
//        $input['concession_allowed_on'] = $this->mySqlDate($requestData->concession_allowed_on);
//       if($requestData->print_ticket=="Yse")
//        {
//         $input[print_ticket] = $userid=$requestData->print_ticket;  
//        } else {
//         $input[print_ticket] = "No";     
//        }
        $pass_pypes = PassType::create($input);
        Session::flash('flash_message', "Pass Type Created Successfully."); //Snippet in Master.blade.php
        return $pass_pypes;
       
    }
 public function update($id, $requestData) {
        $this->createLog('App\Models\PassType','App\Models\PassTypeLog',$id);
        $pass_pypes = PassType::findorFail($id);
        $input = $requestData->all();
        $userid = Auth::id();
        $input[user_id] = $userid;
        $pass_pypes->fill($input)->save();
        Session::flash('flash_message', "Pass Type Updated Successfully.");
        return $pass_pypes;
    }

}
