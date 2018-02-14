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
use App\Traits\activityLog;

class FareRepository implements FareRepositoryContract {
   use FormatDates;
   use activityLog;
    public function find($id) {
        return Fare::join('routes', 'users.user_type', '=', 'roles.id')->first(1);
    }

    public function getAllFares() {
        return Fare::all();
    }
    
public function create($requestData) {

        
$stage=  $requestData->stage;
$userid = Auth::id();
$adult_ticket_amount = $requestData->adult_ticket_amount;
$child_ticket_amount = $requestData->child_ticket_amount;
$luggage_ticket_amount = $requestData->luggage_ticket_amount;
$service_id = $requestData->service_id;

$input = $requestData->all();
$userid = Auth::id();
$input['adult_ticket_amount'] = '';
$input['adult_ticket_amount'] = '';
$input['luggage_ticket_amount'] = '';
$input['stage'] = '';
$input['user_id'] = $userid;
$input['service_id'] = $requestData->service_id;;
$fares = Fare::create($input);

foreach($stage as $key => $n ) 
{
$id = DB::table('fare_details')->insertGetId(
    ['service_id' =>$service_id,'user_id' =>$userid, 'stage' => $stage[$key],'adult_ticket_amount'=>$adult_ticket_amount[$key],'child_ticket_amount'=>$child_ticket_amount[$key],'luggage_ticket_amount'=>$luggage_ticket_amount[$key]]
);

}	
 Session::flash('flash_message', "Fare Created Successfully."); //Snippet in Master.blade.php
 return $id;
 
    }
 public function update($id, $requestData) {
 $stage=  $requestData->stage;
$userid = Auth::id();
$adult_ticket_amount = $requestData->adult_ticket_amount;
$child_ticket_amount = $requestData->child_ticket_amount;
$luggage_ticket_amount = $requestData->luggage_ticket_amount;
 $service_id = $requestData->service_id;

//$sql=Fare::where('service_id',$service_id)->first();
//echo count($sql);
//
//
//if(count($sql)>0)
//{
//    
//}else{
$input = $requestData->all();
$userid = Auth::id();
$input['adult_ticket_amount'] = '';
$input['adult_ticket_amount'] = '';
$input['luggage_ticket_amount'] = '';
$input['stage'] = '';
$input['user_id'] = $userid;
$input['service_id'] = $requestData->service_id;
$fares = Fare::create($input);

foreach($stage as $key => $n ) 
{
$id = DB::table('fare_details')->insertGetId(
    ['service_id' =>$service_id,'user_id' =>$userid, 'stage' => $stage[$key],'adult_ticket_amount'=>$adult_ticket_amount[$key],'child_ticket_amount'=>$child_ticket_amount[$key],'luggage_ticket_amount'=>$luggage_ticket_amount[$key]]
);

}
//}





$fares->fill($input)->save();
        Session::flash('flash_message', "Fare Updated Successfully.");
        return $fares;
    }

}
