<?php

namespace App\Repositories\Depot;
use App\Models\Depot;
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
use App\Mail\DepotCreated;

class DepotRepository implements DepotRepositoryContract {
  public function find($id) {
        return Depot::join('depots', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllDepots() {
        return Depot::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $input['user_id'] = Auth::id();
        $depot = Depot::create($input);
        Session::flash('flash_message', "$depot->name Depot Created Successfully."); //Snippet in Master.blade.php
        return $depot;
    }

    public function update($id, $requestData) {
       $depot = Depot::findorFail($id);
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $depot->fill($input)->save();
       Session::flash('flash_message', "$depot->name Depot Updated Successfully.");
       return $depot;
    }


}
