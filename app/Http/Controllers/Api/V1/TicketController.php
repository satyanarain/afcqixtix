<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use Session;
use Validator;
use App\Models\Depot;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\Concession;
use Illuminate\Http\Request;
use App\Events\ETMDataUpdated;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'ticket_type' => 'required',
    		'total_amt' => 'required',
    		'abstract_id' => 'required',
    		'trip_id' => 'required',
    		'sold_at' => 'required',
    	]);

    	if($validator->fails())
    	{
            return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
    	}
        
    	$ticket = Ticket::create($request->except(['token']));
    	return response()->json(['statusCode'=>'Ok', 'data'=>$ticket]);
    }

    public function importTickets(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
        }

        $jsonDecoded = json_decode($request->data, true);

        $insertedData = [];

        $abstract_no = "";

        foreach ($jsonDecoded as $key => $value) 
        {
            //return $value;
            try{
                $concession = Concession::whereId($value['concession_id'])->first();
                if($concession)
                {
                    if($concession->flat_fare == "Yes")
                    {
                        $concessionAmt = $concession->flat_fare_amount;
                    }else{
                        $concessionAmt = (int)$concession->percentage/(100-(int)$concession->percentage)*(int)$value['total_amt'];
                    }
                }
                $value['concession_amt'] = $concessionAmt;
                $ticket = Ticket::create($value);
                $insertedData[] = ['id'=>$value['local_id'], 'status'=>1];
                $abstract_no = $value['abstract_id'];
            } catch (\Illuminate\Database\QueryException $exception) {
                return $exception->getMessage();
                $insertedData[] = ['id'=>$value['local_id'], 'status'=>0];
            }            
        }

        $statusData = DB::table('etm_login_log')
                            ->leftJoin('crew as conductor', 'etm_login_log.conductor_id', '=', 'conductor.id')
                            ->leftJoin('shift_start', 'etm_login_log.abstract_no', '=', 'shift_start.abstract_no')
                            ->leftJoin('etm_details', 'etm_login_log.etm_id', '=', 'etm_details.id')
                            ->leftJoin('depots', 'etm_details.depot_id', '=', 'depots.id')
                            ->leftJoin('route_master', 'shift_start.route_id', '=', 'route_master.id')
                            ->leftJoin('duties', 'shift_start.duty_id', '=', 'duties.id')
                            ->leftJoin('shifts', 'shift_start.shift_id', '=', 'shifts.id')
                            ->leftJoin('vehicles', 'shift_start.vehicle_id', '=', 'vehicles.id')
                            ->leftJoin('crew as driver', 'shift_start.driver_id', '=', 'driver.id');
                            
        //return Session::get('depotId');
        if(null !== Session::get('depotId'))
        {
            $statusData = $statusData->where('etm_details.depot_id', session('depotId'));
        }

        $statusData = $statusData->select('etm_login_log.gprs_level', 'etm_login_log.battery_percentage', 'etm_login_log.etm_id', 'etm_login_log.abstract_no', 'conductor.crew_name as conductor_name', 'conductor.crew_id as conductor_id', 'conductor.mobile', 'driver.crew_name as driver_name', 'driver.crew_id as driver_id', 'route_master.route_name', 'duties.duty_number', 'shifts.shift', 'vehicles.vehicle_registration_number', 'etm_login_log.login_timestamp', 'etm_login_log.logout_timestamp', 'shift_start.route_id', 'shift_start.duty_id', 'shift_start.shift_id', 'shift_start.vehicle_id', 'conductor.id as conductorId', 'driver.id as driverId')
                            ->where('etm_login_log.abstract_no', $abstract_no)
                            ->first();

        $parameters = DB::table('etm_health_status_params')->get();

        if ($statusData) 
        {
            if($abstract_no)
            {
                $lastTicket = Ticket::where('abstract_id', $abstract_no)->orderBy('id', 'desc')->first();
                $statusData->last_ticket_issued = $lastTicket->sold_at;
                $statusData->last_communicated = date('Y-m-d H:i:s', strtotime($lastTicket->created_at));

                $lastCommunicatedSeconds = strtotime($statusData->last_communicated) / 60;
                $lastTicketIssuedSeconds = strtotime($statusData->last_ticket_issued) / 60;
                $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;
                $lastTicketIssued = $nowSeconds - $lastTicketIssuedSeconds;

                $statusData->last_communicated_minutes = (int)$lastCommunicated;

                //match against waybill
                $waybill = Waybill::where('abstract_no', $abstract_no)->first();
                if($waybill)
                {
                    if($waybill->etm_no != $statusData->etm_id || $waybill->abstract_no != $statusData->abstract_no)
                    {
                        $statusData->etm_abstract_box_class = "red";
                    }else{
                        $statusData->etm_abstract_box_class = "";
                    }
                    //echo $waybill->conductor_id . "=>" . $statusData->conductorId . "=>" . $waybill->driver_id . "=>" . $statusData->driverId."</br>";
                    if($waybill->conductor_id != $statusData->conductorId || $waybill->driver_id != $statusData->driverId)
                    {
                        $statusData->conductor_driver_box_class = "red";
                    }else{
                        $statusData->conductor_driver_box_class = "";
                    }

                    if($waybill->route_id != $statusData->route_id || $waybill->duty_id != $statusData->duty_id || $waybill->shift_id != $statusData->shift_id)
                    {
                        $statusData->route_duty_shift_box_class = "red";
                    }else{
                        $statusData->route_duty_shift_box_class = "";
                    }

                    if($waybill->vehicle_id != $statusData->vehicle_id)
                    {
                        $statusData->bus_box_class = "red";
                    }else{
                        $statusData->bus_box_class = "";
                    }
                }else{
                    $statusData->etm_abstract_box_class = "";
                    $statusData->conductor_driver_box_class = "";                    
                    $statusData->route_duty_shift_box_class = "";
                    $statusData->bus_box_class = "";
                }

                $lastTicket = Ticket::where('abstract_id', $abstract_no)->orderBy('id', 'desc')->first();
                if($lastTicket)
                {
                    $statusData->last_ticket_issued = $lastTicket->sold_at;
                    $statusData->last_communicated = $lastTicket->created_at;

                    $lastCommunicatedSeconds = strtotime($statusData->last_communicated) / 60;
                    $lastTicketIssuedSeconds = strtotime($statusData->last_ticket_issued) / 60;
                    $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                    $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;
                    $lastTicketIssued = $nowSeconds - $lastTicketIssuedSeconds;

                    $statusData->last_communicated = date('Y-m-d H:i:s', strtotime($lastTicket->created_at)) . " (".(int)$lastCommunicated. ")";
                }else{
                    $lastTrip = TripStart::where('abstract_no', $abstract_no)->orderBy('id', 'desc')->first();
                    if($lastTrip)
                    {
                        $statusData->last_ticket_issued = "";
                        $statusData->last_communicated = $lastTrip->created_at;

                        $lastCommunicatedSeconds = strtotime($statusData->last_communicated) / 60;
                        $lastTicketIssuedSeconds = "";
                        $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                        $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                        $statusData->last_communicated = date('Y-m-d H:i:s', strtotime($lastTrip->created_at)) . " (".(int)$lastCommunicated. ")";
                    }else{
                        $statusData->last_ticket_issued = "";
                        $statusData->last_communicated = $statusData->login_timestamp;

                        $lastCommunicatedSeconds = strtotime($statusData->last_communicated) / 60;
                        $lastTicketIssuedSeconds = "";
                        $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                        $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                        $statusData->last_communicated = date('Y-m-d H:i:s', strtotime($statusData->last_communicated)) . " (".(int)$lastCommunicated. ")";
                    }
                }

            }else{
                $statusData->last_ticket_issued = "";
                $statusData->last_communicated = $statusData->login_timestamp;

                $lastCommunicatedSeconds = strtotime($statusData->last_communicated) / 60;
                $lastTicketIssuedSeconds = "";
                $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                $statusData->last_communicated = date('Y-m-d H:i:s', strtotime($statusData->last_communicated)) . " (".(int)$lastCommunicated. ")";
            }

            $statusData->abstract_number = $abstract_no;
            $statusData->etm_abstract = $statusData->etm_id." / ". $abstract_no;
            $statusData->conductor_driver = $statusData->conductor_name." (".$statusData->conductor_id.")"." / ". $statusData->driver_name." (".$statusData->driver_id.")";
            $statusData->login_logout = $statusData->login_timestamp." / ". $statusData->logout_timestamp;
            $statusData->route_duty_shift = $statusData->route_name."-".$statusData->duty_number."-".$statusData->shift;
            $statusData->bus = $statusData->vehicle_registration_number;

            foreach ($parameters as $key => $pvalue) 
            {
                if($pvalue->battery_percentage_min <= $statusData->battery_percentage && $statusData->battery_percentage <= $pvalue->battery_percentage_max)
                {
                    $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                    if($color)
                    {
                        $statusData->battery_percentage_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $statusData->battery_percentage_box_class = "red";
                }
            }
            foreach ($parameters as $key => $pvalue) 
            {
                if($pvalue->gprs_level_min <= $statusData->gprs_level && $statusData->gprs_level <= $pvalue->gprs_level_max)
                {
                    $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                    if($color)
                    {
                        $statusData->gprs_level_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $statusData->gprs_level_box_class = "red";
                }
            }

            foreach ($parameters as $key => $pvalue) 
            {
                //echo $pvalue->last_communicated_min."=>".$lastCommunicated."=>".$pvalue->last_communicated_max."</br>";
                if($pvalue->last_communicated_min <= $lastCommunicated && $lastCommunicated <= $pvalue->last_communicated_max)
                {
                    $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                    if($color)
                    {
                        $statusData->last_communicated_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $statusData->last_communicated_box_class = "red";
                }
            }

            foreach ($parameters as $key => $pvalue) 
            {
                //echo $pvalue->last_ticket_issued_min."=>".$lastTicketIssued."=>".$pvalue->last_ticket_issued_max."</br>";
                if($pvalue->last_ticket_issued_min <= $lastTicketIssued && $lastCommunicated <= $pvalue->last_ticket_issued_max)
                {
                    $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                    if($color)
                    {
                        $statusData->last_ticket_issued_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $statusData->last_ticket_issued_box_class = "red";
                }
            }
        }

        $broadcastData = ['flag'=>0, 'data'=>$statusData];

        event(new ETMDataUpdated($broadcastData));

        return response()->json($insertedData);
    }


    public function testAPI(Request $request)
    {
        var_dump($request->all());
        return response()->json($request->all());
    }
}
