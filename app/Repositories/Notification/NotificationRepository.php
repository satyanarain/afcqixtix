<?php

namespace App\Repositories\Notification;
use App\Models\Notification;
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
use App\Mail\NotificationCreated;
use App\Traits\activityLog;
class NotificationRepository implements NotificationRepositoryContract {
    use activityLog;
  public function find($id) {
        return Notification::join('notifications', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllNotification() {
        return Notification::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $input['user_id'] = Auth::id();
        $depot = Notification::create($input);
        Session::flash('flash_message', "Notification Created Successfully."); //Snippet in Master.blade.php
        return $depot;
    }

    public function update($id, $requestData) {
       //$this->createLog('App\Models\Notification','App\Models\NotificationLog',$id);
       $depot = Notification::findorFail($id);
       //echo '<pre>';print_r($requestData->all());die;
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $depot->fill($input)->save();
       Session::flash('flash_message', "Notification Updated Successfully.");
       return $depot;

    }


}
