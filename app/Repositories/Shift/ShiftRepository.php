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
use App\Traits\activityLog;
class ShiftRepository implements ShiftRepositoryContract {
    use FormatDates;
    use activityLog;
    
    public function find($id) {
        return Shift::join('shifts', 'users.user_type', '=', 'roles.id')->first();
        
    }

    public function getAllShifts() {
        return Shift::all();
    }

public function create($requestData) {
        $input = $requestData->all();
        $input['user_id']=Auth::id();
        $shift = Shift::create($input);
        Session::flash('flash_message', "$shift->name Shift Created Successfully."); //Snippet in Master.blade.php
        return $shift;
    }

public function update($id, $requestData) {
        $this->createLog('App\Models\Shift', 'App\Models\ShiftLog', $id);
        $shift = Shift::findorFail($id);
        $input = $requestData->all();
        $shift_val = $requestData->shift;
        $sql = Shift::where([['shift', $shift_val], ['id', '!=', $id]])->first();
        if (count($sql) > 0) {
            return redirect()->back()->withErrors(['Shift name has already been taken.']);
        } else {
            $input['user_id'] = Auth::id();
            $shift->fill($input)->save();
            Session::flash('flash_message', "$shift->name Shift Updated Successfully.");
            return $shift;
        }
    }

    
    
    
    
}
