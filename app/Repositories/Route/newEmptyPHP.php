<?php

namespace App\Repositories\Route;

use App\Models\Route;
use App\Models\RouteDetail;
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

class RouteRepository implements RouteRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return Route::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllRoutes() {
        return Route::all();
    }
    
public function create($requestData) {

$input = $requestData->all();
$user_id = Auth::id();
$input['user_id'] = $user_id;



$routes_id = Route::create(['user_id'=>$user_id,'route'=>$requestData->route,'source'=>$requestData->source,'destination'=>$requestData->destination,'via'=>$requestData->via,'direction'=>$requestData->direction,'default_path'=>$requestData->default_path])->id;


$stop_id = $requestData->stop_id;
$stage_number = $requestData->stage_number;
$distance = $requestData->distance;
$hot_key = $requestData->hot_key;
$is_this_by = $requestData->is_this_by;
//echo "<pre>";
//print_r($_POST);
//exit();


foreach($stop_id as $key => $n ) 
{
$id = DB::table('route_details')->insertGetId(
    ['route_id' =>$routes_id,'stop_id' =>$stop_id[$key], 'stage_number' => $stage_number[$key],'distance'=>$distance[$key],'hot_key'=>$hot_key[$key],'is_this_by'=>$is_this_by[$key]]
);

}	
 Session::flash('flash_message', "Route Updated Successfully."); //Snippet in Master.blade.php
 return $id;
 
}
    
 public function update($id, $requestData) {
$input = Route::findorFail($id);
$user_id = Auth::id();

//$input['route']=$requestData->route;
//$input['source']=$requestData->source;
//$input['destination']=$requestData->destination;
//$input['via']=$requestData->via;
//$input['direction']=$requestData->direction;
//$input['default_path']=$requestData->default_path;
//DB::table('routes')->where('id', $id)->update(['user_id'=>$user_id,'route' =>$requestData->route,'source' =>$requestData->route,'destination' =>$requestData->destination,'via' =>$requestData->via,'direction' =>$requestData->direction,'default_path' =>$requestData->default_path]);

$stop_id = $requestData->stop_id;
$stage_number = $requestData->stage_number;
$distance = $requestData->distance;
$hot_key = $requestData->hot_key;
$is_this_by = $requestData->is_this_by;
$delete=DB::table('route_details')->where('route_id',$id)->get();

if(count($delete)>0)
{
foreach($delete as $delete_id) 
{
  $del_id= $delete_id->id;
  RouteDetail::destroy($del_id);
}
}

foreach($stage as $key => $n ) 
{
$sql_update=DB::table('route_details')->insertGetId(
    ['route_id' =>$id, 'stop_id' => $stop_id[$key],'stage_number'=>$stage_number[$key],'distance'=>$distance[$key],'hot_key'=>$hot_key[$key],'is_this_by'=>$is_this_by[$key]]
);

}

 Session::flash('flash_message', "Route Created Successfully."); //Snippet in Master.blade.php

 
 return $id;
 
}
}