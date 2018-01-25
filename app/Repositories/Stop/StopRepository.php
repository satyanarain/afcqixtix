<?php

namespace App\Repositories\Stop;
use App\Models\Stop;
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
use App\Mail\StopCreated;
class StopRepository implements StopRepositoryContract {
  public function find($id) {
        return Stop::join('stops', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllStops() {
        return Stop::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $user_id=Auth::id();
        $input['user_id']=$user_id;
        $depot = Stop::create($input);
        Session::flash('flash_message', "$depot->stop Stop Created Successfully."); //Snippet in Master.blade.php
        return $depot;
    }

    public function update($id, $requestData) {
       $depot = Stop::findorFail($id);
       $input = $requestData->all();
       $user_id=Auth::id();
       $input['user_id']=$user_id;
       $depot->fill($input)->save();
       Session::flash('flash_message', "$depot->stop Stop Updated Successfully.");
       return $depot;
    }


}
