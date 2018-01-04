<?php

namespace App\Repositories\Route;

use App\Models\Route;
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
use App\Mail\RouteCreated;
use App\Traits\FormatDates;

class RouteRepository implements RouteRepositoryContract {
   use FormatDates;
    public function find($id) {
        return Route::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllRoutes() {
        return Route::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $userid = Auth::id();
        $input['user_id'] = $userid;
        $route = Route::create($input);
        Session::flash('flash_message', "$route->route Route Created Successfully."); //Snippet in Master.blade.php
        return $route;
    }

    public function update($id, $requestData) {
        $route = Route::findorFail($id);
        $input = $requestData->all();
        $userid = Auth::id();
        $input[user_id] = $userid;
        $route->fill($input)->save();
        Session::flash('flash_message', "$route->route Route Updated Successfully.");
        return $route;
    }

}
