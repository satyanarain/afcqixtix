<?php

namespace App\Repositories\CrewDetail;
use App\Models\CrewDetail;
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
use App\Mail\CrewDetailCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;
class CrewDetailRepository implements CrewDetailRepositoryContract {
      use FormatDates;
      use activityLog;
  public function find($id) {
        return CrewDetail::join('crew_details', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllCrewDetails() {
        return CrewDetail::all();
    }

    public function create($requestData) {
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $input['valid_up_to']= $this->insertDate($requestData->valid_up_to);
       $input['date_of_birth']= $this->insertDate($requestData->date_of_birth);
       $input['date_of_join']= $this->insertDate($requestData->date_of_join);
       $input['date_of_leaving']= $this->insertDate($requestData->date_of_leaving);
       $crew_detail = CrewDetail::create($input);
       Session::flash('flash_message', "$crew_detail->name CrewDetail Created Successfully."); //Snippet in Master.blade.php
       return $crew_detail;
    }

    public function update($id, $requestData) {
       $this->createLog('App\Models\CrewDetail','App\Models\CrewDetailLog',$id);
       $crew_detail = CrewDetail::findorFail($id);
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $input['valid_up_to']= $this->insertDate($requestData->valid_up_to);
       $input['date_of_birth']= $this->insertDate($requestData->date_of_birth);
       $input['date_of_join']= $this->insertDate($requestData->date_of_join);
       $input['date_of_leaving']= $this->insertDate($requestData->date_of_leaving);
       $crew_detail->fill($input)->save();
       Session::flash('flash_message', "$crew_detail->name CrewDetail Updated Successfully.");
       return $crew_detail;
    }


}
