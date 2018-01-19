<?php

namespace App\Repositories\Target;

use App\Models\Target;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\TargetLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TargetCreated;
use App\Traits\FormatDates;

class TargetRepository implements TargetRepositoryContract {
   use FormatDates;
    public function find($id) {
        return Target::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllTargets() {
        return Target::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $targets = Target::create($input);
        Session::flash('flash_message', "Target Created Successfully."); //Snippet in Master.blade.php
        return $targets;
    }

    public function update($id, $requestData) {
//       $targets_log = Target::where('id', '=', $id )->get()->toArray();
//  
//         foreach ($targets_log as $item) 
//        {
//              TargetLog::create($item);
//        }
//        
//        
        
        $targets = Target::findorFail($id);
        $input = $requestData->all();
        $userid = Auth::id();
        $input[user_id] = $userid;
        $targets->fill($input)->save();
        Session::flash('flash_message', "Target Updated Successfully.");
        return $targets;
    }

}
