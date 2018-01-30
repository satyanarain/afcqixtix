<?php

namespace App\Repositories\Concession;

use App\Models\Concession;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\ConcessionLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConcessionCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class ConcessionRepository implements ConcessionRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return Concession::join('concessions', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllConcessions() {
        return Concession::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
     
        $input['user_id'] = $userid;
        $input['concession_allowed_on'] = $this->mySqlDate($requestData->concession_allowed_on);
        if($requestData->print_ticket==1)
        {
         $input[print_ticket] = $userid=$requestData->print_ticket;  
        } else {
         $input[print_ticket] = 0;     
        }
        $concession = Concession::create($input);
        Session::flash('flash_message', "Concession Fare Slab Created Successfully."); //Snippet in Master.blade.php
        return $concession;
       
    }
 public function update($id, $requestData) {
        $this->createLog('App\Models\Concession','App\Models\ConcessionLog',$id);
        $concession = Concession::findorFail($id);
        $input = $requestData->all();
        $input['concession_allowed_on'] = $this->mySqlDate($requestData->concession_allowed_on);
        $userid = Auth::id();
        $input[user_id] = $userid;
        if($requestData->print_ticket==1)
        {
         $input[print_ticket] = $userid=$requestData->print_ticket;  
        } else {
         $input[print_ticket] = 0;     
        }
        
        
        
        $concession->fill($input)->save();
        Session::flash('flash_message', "Concession Fare Slab Updated Successfully.");
        return $concession;
    }

}
