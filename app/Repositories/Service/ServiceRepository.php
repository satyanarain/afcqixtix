<?php

namespace App\Repositories\Service;
use App\Models\Service;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceCreated;
class ServiceRepository implements ServiceRepositoryContract {
  public function find($id) {
        return Service::join('services', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllServices() {
        return Service::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $input['user_id'] = Auth::id();
        $service = Service::create($input);
        Session::flash('flash_message', "$service->name Service Created Successfully."); //Snippet in Master.blade.php
        return $service;
    }

    public function update($id, $requestData) {
       $service = Service::findorFail($id);
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $service->fill($input)->save();
       Session::flash('flash_message', "$service->name Service Updated Successfully.");
       return $service;
    }


}
