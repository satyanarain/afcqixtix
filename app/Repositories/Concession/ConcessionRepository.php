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
        return Concession::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllConcessions() {
        return Concession::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $concession_fare_slabs = Concession::create($input);
        Session::flash('flash_message', "Concession Fare Slab Created Successfully."); //Snippet in Master.blade.php
        return $concession_fare_slabs;
       
    }
 public function update($id, $requestData) {
        $this->createLog('App\Models\Concession','App\Models\ConcessionLog',$id);
        $concession_fare_slabs = Concession::findorFail($id);
        $input = $requestData->all();
        $userid = Auth::id();
        $input[user_id] = $userid;
        $concession_fare_slabs->fill($input)->save();
        Session::flash('flash_message', "Concession Fare Slab Updated Successfully.");
        return $concession_fare_slabs;
    }

}
