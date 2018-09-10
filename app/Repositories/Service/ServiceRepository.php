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
use App\Traits\activityLog;

class ServiceRepository implements ServiceRepositoryContract {
    use activityLog;
  public function find($id) {
        return Service::join('services', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllServices() {
        return Service::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $input['user_id'] = Auth::id();
        $name = $requestData->name;
        $bus_type_id = $requestData->bus_type_id;
      $sql=Service::where([['name',$name],['bus_type_id',$bus_type_id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Bus type and service name has already been taken.']);
      } else {
        $service = Service::create($input);
        Session::flash('flash_message', "$service->name Service Created Successfully."); //Snippet in Master.blade.php
        return $service;
      }
    }

    public function update($id, $requestData) {
       //$this->createLog('App\Models\Service','App\Models\ServiceLog',$id);
       $service = Service::findorFail($id);
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $name = $requestData->name;
        $bus_type_id = $requestData->bus_type_id;
         $sql=Service::where([['name',$name],['bus_type_id',$bus_type_id],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Bus type and service name has already been taken.']);
      } else {
         $service->fill($input)->save();
       Session::flash('flash_message', "$service->name Service Updated Successfully.");
       return $service;
      }
    }


}
