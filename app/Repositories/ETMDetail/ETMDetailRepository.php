<?php

namespace App\Repositories\ETMDetail;
use App\Models\ETMDetail;
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
use App\Mail\ETMDetailCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;
class ETMDetailRepository implements ETMDetailRepositoryContract {
      use FormatDates;
      use activityLog;
  public function find($id) {
        return ETMDetail::join('ETM_details', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllETMDetails() {
        return ETMDetail::all();
    }

    public function create($requestData) {
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $input['warranty']= $this->insertDate($requestData->warranty);
       $crew_detail = ETMDetail::create($input);
       Session::flash('flash_message', "$crew_detail->name ETMDetail Created Successfully."); //Snippet in Master.blade.php
       return $crew_detail;
    }

    public function update($id, $requestData) {
       //$this->createLog('App\Models\ETMDetail','App\Models\ETMDetailLog',$id);
       $crew_detail = ETMDetail::findorFail($id);
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $input['warranty']= $this->insertDate($requestData->warranty);
       $crew_detail->fill($input)->save();
       Session::flash('flash_message', "$crew_detail->name ETMDetail Updated Successfully.");
       return $crew_detail;
    }


}
