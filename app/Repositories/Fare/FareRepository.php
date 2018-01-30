<?php

namespace App\Repositories\Fare;

use App\Models\Fare;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\FareLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\FareCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class FareRepository implements FareRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return Fare::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllFares() {
        return Fare::all();
    }

    public function create($requestData) {
      
          $fares = DB::table('fares')->select('*')
                ->where([['service_id',$requestData->service_id],['stage',$requestData->stage]])
                ->first();
        if(count( $fares)>0)
        {
          Session::flash('error', "Service Name and stage must be uquque.");
        
        } else {
        
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $fares = Fare::create($input);
        Session::flash('flash_message', "Fare Created Successfully."); //Snippet in Master.blade.php
        return $fares;
        }
    }
 public function update($id, $requestData) {
       // $this->createLog('App\Models\Fare','App\Models\FareLog',$id);
        $fares = Fare::findorFail($id);
        $input = $requestData->all();
        $userid = Auth::id();
        $input[user_id] = $userid;
        $fares->fill($input)->save();
        Session::flash('flash_message', "Fare Updated Successfully.");
        return $fares;
    }

}
