<?php

namespace App\Repositories\Shift;
use App\Models\Shift;
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
use App\Mail\ShiftCreated;
use App\Traits\FormatDates;
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
        $shift = Shift::create($input);
        Session::flash('flash_message', "$shift->name Shift Created Successfully."); //Snippet in Master.blade.php
        return $shift;
    }

public function update($id, $requestData) {
       $shift = Shift::findorFail($id);
       $input = $requestData->all();
       $shift->fill($input)->save();
       Session::flash('flash_message', "$shift->name Shift Updated Successfully.");
       return $shift;
    }


}
