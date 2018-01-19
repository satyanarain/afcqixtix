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

class FareRepository implements FareRepositoryContract {
   use FormatDates;
    public function find($id) {
        return Fare::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllFares() {
        return Fare::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $targets = Fare::create($input);
        Session::flash('flash_message', "Fare Created Successfully."); //Snippet in Master.blade.php
        return $targets;
    }

    public function update($id, $requestData) {
//       $targets_log = Fare::where('id', '=', $id )->get()->toArray();
//     unset($targets_log['id']);
//         foreach ($targets_log as $item) 
//        {
//              FareLog::create($item);
//        }
        
        $targets = Fare::findorFail($id);
        $input = $requestData->all();
        $userid = Auth::id();
        $input[user_id] = $userid;
        $targets->fill($input)->save();
        Session::flash('flash_message', "Fare Updated Successfully.");
        return $targets;
    }

}
