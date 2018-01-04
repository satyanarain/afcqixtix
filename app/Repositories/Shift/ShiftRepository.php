<?php

namespace App\Repositories\Shift;
use DB;
use Gate;
use Carbon;
use Datatables;
use Notifynder;
use App\Models\Role;
use App\Models\Shift;
use App\Mail\ShiftCreated;
use App\Traits\FormatDates;
use Illuminate\Http\Request;
use PHPZen\LaravelRbac\Traits\Rbac;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class ShiftRepository implements ShiftRepositoryContract {
    use FormatDates;
    
    public function find($id) {
        return Shift::join('shifts', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllShifts() {
        return Shift::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $input['start_date']=$this->changeDateFromDMYToYMD($requestData->start_date);
        $input['end_date']=$this->changeDateFromDMYToYMD($requestData->end_date);
        $input['user_id'] = Auth::id(); 
        $shift = Shift::create($input);
        Session::flash('flash_message', "$shift->name Shift Created Successfully."); //Snippet in Master.blade.php
        return $shift;
    }

    public function update($id, $requestData) {
       $shift = Shift::findorFail($id);
       $input = $requestData->all();
       $input['start_date']=$this->changeDateFromDMYToYMD($requestData->start_date);
       $input['end_date']=$this->changeDateFromDMYToYMD($requestData->end_date);
       $shift->fill($input)->save();
       Session::flash('flash_message', "$shift->name Shift Updated Successfully.");
       return $shift;
    }


}
