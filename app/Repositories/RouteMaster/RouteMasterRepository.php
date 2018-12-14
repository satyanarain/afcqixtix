<?php

namespace App\Repositories\RouteMaster;

use App\Models\RouteMaster;
use App\Models\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\RouteLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RouteCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class RouteMasterRepository implements RouteMasterRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return RouteMaster::join('route_master', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllRoutes() {
        return RouteMaster::all();
    }
    
public function create($requestData) {

$input = $requestData->all();
$user_id = Auth::id();
$input['user_id'] = $user_id;
$routes_id = RouteMaster::create(['approval_status'=>'p','user_id'=>$user_id,'route_name'=>$requestData->route_name,'version_id'=>$requestData->version_id,'flag'=>$requestData->flag])->id;
Session::flash('flash_message', "Route Updated Successfully."); //Snippet in Master.blade.php
 return $id;
 
}
    
 public function update($id, $requestData) {
     //$this->createLog('App\Models\Route','App\Models\RouteLog',$id);
  $routes=  RouteMaster::findorFail($id) ;
     
$input = $requestData->all();
$user_id = Auth::id();
$input['user_id'] = $user_id;

    $route = $requestData->route;
      $sql=RouteMaster::where([['route_name',$route],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
         return redirect('routes/' . $id . '/edit')->withErrors(['Route has already been taken.']);
 
      } else {
        $routes = $routes->fill($input)->save();
      }
        Session::flash('flash_message', "Route Created Successfully."); //Snippet in Master.blade.php
        return $id;
}
}