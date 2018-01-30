<?php

namespace App\Repositories\ConcessionFareSlab;

use App\Models\ConcessionFareSlab;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\ConcessionFareSlabLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConcessionFareSlabCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class ConcessionFareSlabRepository implements ConcessionFareSlabRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return ConcessionFareSlab::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllConcessionFareSlabs() {
        return ConcessionFareSlab::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $concession_fare_slabs = ConcessionFareSlab::create($input);
        Session::flash('flash_message', "Concession Fare Slab Created Successfully."); //Snippet in Master.blade.php
        return $concession_fare_slabs;
       
    }
 public function update($id, $requestData) {
        $this->createLog('App\Models\ConcessionFareSlab','App\Models\ConcessionFareSlabLog',$id);
        $concession_fare_slabs = ConcessionFareSlab::findorFail($id);
        $input = $requestData->all();
        $userid = Auth::id();
        $input[user_id] = $userid;
        $concession_fare_slabs->fill($input)->save();
        Session::flash('flash_message', "Concession Fare Slab Updated Successfully.");
        return $concession_fare_slabs;
    }

}
