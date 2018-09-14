<?php

namespace App\Repositories\Trip;

use App\Models\Trip;
use App\Models\TripDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\TripLog;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TripCreated;
use App\Traits\FormatDates;
use App\Traits\activityLog;

class TripRepository implements TripRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return Trip::join('$trips', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllTrips() {
        return Trip::all();
    }
    
public function create($requestData) {

$input = $requestData->all();
$user_id = Auth::id();
$input['user_id'] = $user_id;

$trips_id = Trip::create(['approval_status'=>'p','version_id'=>$requestData->version_id,'flag'=>'a','user_id'=>$user_id,'route_id'=>$requestData->route_id,'duty_id'=>$requestData->duty_id,'shift_id'=>$requestData->shift_id,'trip_no'=>$requestData->trip_no])->id;
$trip_no = $requestData->trip_no;
$start_time = $requestData->start_time;
$path_route_id = $requestData->path_route_id;
$deviated_route = $requestData->deviated_route;
$deviated_path = $requestData->deviated_path;

foreach($trip_no as $key => $n ) 
{
  
   $id = DB::table('trip_details')->insertGetId(
    ['trip_id' =>$trips_id,'trip_no' =>$trip_no[$key], 'start_time' => $start_time[$key],'path_route_id'=>$path_route_id[$key],'deviated_route'=>$deviated_route[$key],'deviated_path'=>$deviated_path[$key]]
);

}

Session::flash('flash_message', "Trip Updated Successfully."); //Snippet in Master.blade.php
 return $id;
 
}
    
 public function update($id, $requestData) {
//$this->createLog('App\Models\Trip','App\Models\TripLog',$id);
$trips=  Trip::findorFail($id) ;
$input = $requestData->all();
$user_id = Auth::id();
$input['user_id'] = $user_id;
$route = $requestData->route;
    /*  $sql=Trip::where([['route',$route],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
         return redirect('$trips/' . $id . '/edit')->withErrors(['Trip has already been taken.']);
 
      } else {*/
$trips = $trips->fill($input)->save();
  //    }

$trip_no = $requestData->trip_no;
$start_time = $requestData->start_time;
$path_route_id = $requestData->path_route_id;
$deviated_route = $requestData->deviated_route;
$deviated_path = $requestData->deviated_path;

$delete=DB::table('trip_details')->where('trip_id',$id)->get();

if(count($delete)>0)
{
foreach($delete as $delete_id) 
{
  $del_id= $delete_id->id;
  TripDetail::destroy($del_id);
}
}

    


foreach($trip_no as $key => $n ) 
{
  
   $sql_update = DB::table('trip_details')->insertGetId(
    ['trip_id' =>$id,'trip_no' =>$trip_no[$key], 'start_time' => $start_time[$key],'path_route_id'=>$path_route_id[$key],'deviated_route'=>$deviated_route[$key],'deviated_path'=>$deviated_path[$key]]
);

}


 Session::flash('flash_message', "Trip Created Successfully."); //Snippet in Master.blade.php
 //return $id;
 
}
}