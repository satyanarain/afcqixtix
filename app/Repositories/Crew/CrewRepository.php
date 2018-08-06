<?php

namespace App\Repositories\Crew;
use App\Models\Crew;
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
use App\Mail\CrewCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;
class CrewRepository implements CrewRepositoryContract {
      use FormatDates;
      use activityLog;
  public function find($id) {
        return Crew::join('crew', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllCrewDetails() {
        return Crew::all();
    }

    public function create($requestData) {
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $input['valid_up_to']= $this->insertDate($requestData->valid_up_to);
       $input['date_of_birth']= $this->insertDate($requestData->date_of_birth);
       $input['date_of_join']= $this->insertDate($requestData->date_of_join);
       $input['date_of_leaving']= $this->insertDate($requestData->date_of_leaving);
       $crew_detail = Crew::create($input);
       Session::flash('flash_message', "$crew_detail->name Crew Created Successfully."); //Snippet in Master.blade.php
       return $crew_detail;
    }

    public function update($id, $requestData) {
       $this->createLog('App\Models\Crew','App\Models\CrewLog',$id);
       $crew_detail = Crew::findorFail($id);
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $input['valid_up_to']= $this->insertDate($requestData->valid_up_to);
       $input['date_of_birth']= $this->insertDate($requestData->date_of_birth);
       $input['date_of_join']= $this->insertDate($requestData->date_of_join);
       $input['date_of_leaving']= $this->insertDate($requestData->date_of_leaving);
       $crew_detail->fill($input)->save();
       Session::flash('flash_message', "$crew_detail->name Crew Updated Successfully.");
       return $crew_detail;
    }


}
