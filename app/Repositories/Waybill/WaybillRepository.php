<?php

namespace App\Repositories\Waybill;
use App\Models\Waybill;
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
use App\Mail\WaybillCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;
class WaybillRepository implements WaybillRepositoryContract {
      use FormatDates;
      use activityLog;
  public function find($id) {
        return Waybill::join('waybills', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllWaybills() {
        return Waybill::all();
    }

    public function create($requestData) {
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $crew_detail = Waybill::create($input);
       Session::flash('flash_message', "Waybill Created Successfully.");
       return $crew_detail;
    }

    public function update($id, $requestData) {
       //$this->createLog('App\Models\Waybill','App\Models\WaybillLog',$id);
       $crew_detail = Waybill::findorFail($id);
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $crew_detail->fill($input)->save();
       Session::flash('flash_message', "Waybill Updated Successfully.");
       return $crew_detail;
    }


}
