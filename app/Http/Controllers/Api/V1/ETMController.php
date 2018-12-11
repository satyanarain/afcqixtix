<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use Date;
use Session;
use Validator;
use App\Models\Depot;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\TripStart;
use App\Models\ETMLoginLog;
use Illuminate\Http\Request;
use App\Events\ETMDataUpdated;
use App\Models\ETMMidLogoffLog;
use App\Http\Controllers\Controller;

class ETMController extends Controller
{
    /**
    *---------------------------------------------------------------------------------------------
    *Update ETM battery and  gprs level
    *@param Request
    *---------------------------------------------------------------------------------------------
    */

    public function updateBatteryAndGPRSLevel(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'gprs_level' => 'required|numeric',
    		'abstract_number' => 'required',
    		'battery_percentage' => 'required|numeric',
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['status'=>'Error', 'data'=>$validator->errors()]);
    	}

    	$log = ETMLoginLog::where('abstract_no', $request->abstract_number)->first();

    	if($log)
    	{
    		$log->battery_percentage = $request->battery_percentage;
    		$log->gprs_level = $request->gprs_level;
    		$log->save();
    		return response()->json(['status'=>'Ok', 'data'=>'GPRS lavel and battery percentage updated successfully.']);
    	}else{
    		return response()->json(['status'=>'Error', 'data'=>'Invalid abstract number!']);
    	}
    }


    /**
    *----------------------------------------------------------------------------------------------------------
    *Show ETM health shatus data for all depos and etm
    *
    *----------------------------------------------------------------------------------------------------------
    */

    public function getETMHealthStatusData()
    {
        $statusData = DB::table('etm_login_log')
                        ->leftJoin('crew as conductor', 'etm_login_log.conductor_id', '=', 'conductor.id')
                        ->leftJoin('shift_start', 'etm_login_log.abstract_no', '=', 'shift_start.abstract_no')
                        ->leftJoin('etm_details', 'etm_login_log.etm_id', '=', 'etm_details.id')
                        ->leftJoin('depots', 'etm_details.depot_id', '=', 'depots.id')
                        ->leftJoin('routes', 'shift_start.route_id', '=', 'routes.id')
                        ->leftJoin('duties', 'shift_start.duty_id', '=', 'duties.id')
                        ->leftJoin('shifts', 'shift_start.shift_id', '=', 'shifts.id')
                        ->leftJoin('vehicles', 'shift_start.vehicle_id', '=', 'vehicles.id')
                        ->leftJoin('crew as driver', 'shift_start.driver_id', '=', 'driver.id');

        //return $statusData;
                            
        $statusData = $statusData->select('etm_login_log.gprs_level', 'etm_login_log.battery_percentage', 'etm_login_log.etm_id', 'etm_login_log.abstract_no', 'conductor.crew_name as conductor_name', 'conductor.crew_id as conductor_id', 'conductor.mobile', 'driver.crew_name as driver_name', 'driver.crew_id as driver_id', 'routes.route', 'duties.duty_number', 'shifts.shift', 'vehicles.vehicle_registration_number', 'etm_login_log.login_timestamp', 'etm_login_log.logout_timestamp', 'shift_start.route_id', 'shift_start.duty_id', 'shift_start.shift_id', 'shift_start.vehicle_id', 'conductor.id as conductorId', 'driver.id as driverId')
            ->whereDate('etm_login_log.login_timestamp', DB::raw('CURDATE()'))
            ->get();

        //return $statusData;

        $parameters = DB::table('etm_health_status_params')->get();

        foreach ($statusData as $key => $value) 
        {
            if($value->abstract_no)
            {
                //match against waybill
                $waybill = Waybill::where('abstract_no', $value->abstract_no)->first();
                if($waybill)
                {
                    if($waybill->etm_no != $value->etm_id || $waybill->abstract_no != $value->abstract_no)
                    {
                        $value->etm_abstract_box_class = "red";
                    }else{
                        $value->etm_abstract_box_class = "";
                    }
                    //echo $waybill->conductor_id . "=>" . $value->conductorId . "=>" . $waybill->driver_id . "=>" . $value->driverId."</br>";
                    if($waybill->conductor_id != $value->conductorId || $waybill->driver_id != $value->driverId)
                    {
                        $value->conductor_driver_box_class = "red";
                    }else{
                        $value->conductor_driver_box_class = "";
                    }

                    if($waybill->route_id != $value->route_id || $waybill->duty_id != $value->duty_id || $waybill->shift_id != $value->shift_id)
                    {
                        $value->route_duty_shift_box_class = "red";
                    }else{
                        $value->route_duty_shift_box_class = "";
                    }

                    if($waybill->vehicle_id != $value->vehicle_id)
                    {
                        $value->bus_box_class = "red";
                    }else{
                        $value->bus_box_class = "";
                    }
                }else{
                    $value->etm_abstract_box_class = "";
                    $value->conductor_driver_box_class = "";                    
                    $value->route_duty_shift_box_class = "";
                    $value->bus_box_class = "";
                }

                $lastTicket = Ticket::where('abstract_id', $value->abstract_no)->orderBy('id', 'desc')->first();
                if($lastTicket)
                {
                    $value->last_ticket_issued = $lastTicket->sold_at;
                    $value->last_communicated = $lastTicket->created_at;

                    $lastCommunicatedSeconds = strtotime($value->last_communicated) / 60;
                    $lastTicketIssuedSeconds = strtotime($value->last_ticket_issued) / 60;
                    $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                    $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;
                    $lastTicketIssued = $nowSeconds - $lastTicketIssuedSeconds;

                    $value->last_communicated = date('Y-m-d H:i:s', strtotime($lastTicket->created_at)) . " (".(int)$lastCommunicated. ")";
                }else{
                    $lastTrip = TripStart::where('abstract_no', $value->abstract_no)->orderBy('id', 'desc')->first();
                    if($lastTrip)
                    {
                        $value->last_ticket_issued = "";
                        $value->last_communicated = $lastTrip->created_at;

                        $lastCommunicatedSeconds = strtotime($value->last_communicated) / 60;
                        $lastTicketIssuedSeconds = "";
                        $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                        $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                        $value->last_communicated = date('Y-m-d H:i:s', strtotime($lastTrip->created_at)) . " (".(int)$lastCommunicated. ")";
                    }else{
                        $value->last_ticket_issued = "";
                        $value->last_communicated = $value->login_timestamp;

                        $lastCommunicatedSeconds = strtotime($value->last_communicated) / 60;
                        $lastTicketIssuedSeconds = "";
                        $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                        $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                        $value->last_communicated = date('Y-m-d H:i:s', strtotime($value->last_communicated)) . " (".(int)$lastCommunicated. ")";
                    }
                }
                
            }else{
                $value->last_ticket_issued = "";
                $value->last_communicated = $value->login_timestamp;

                $lastCommunicatedSeconds = strtotime($value->last_communicated) / 60;
                $lastTicketIssuedSeconds = "";
                $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                $value->last_communicated = date('Y-m-d H:i:s', strtotime($value->last_communicated)) . " (".(int)$lastCommunicated. ")";
            }

            $value->abstract_number = $value->abstract_no;
            $value->etm_abstract = $value->etm_id." / ". $value->abstract_no;
            if(!$value->etm_id || !$value->abstract_no)
            {
                $value->etm_abstract_box_class = "red";
            }else {
                $value->etm_abstract_box_class = "";
            }
            $value->conductor_driver = $value->conductor_name." (".$value->conductor_id.")"." / ". $value->driver_name." (".$value->driver_id.")";
            $value->login_logout = $value->login_timestamp." / ". $value->logout_timestamp;
            $value->mobile = $value->mobile;
            $value->route_duty_shift = $value->route."-".$value->duty_number."-".$value->shift;
            $value->bus = $value->vehicle_registration_number;

            foreach ($parameters as $key => $pvalue) 
            {
                if($pvalue->battery_percentage_min <= $value->battery_percentage && $value->battery_percentage <= $pvalue->battery_percentage_max)
                {
                    //echo $pvalue->battery_percentage_min."=>".$value->battery_percentage."=>".$pvalue->battery_percentage_max.$pvalue->color_id."</br>";
                    $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                    if($color)
                    {
                        $value->battery_percentage_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $value->battery_percentage_box_class = "red";
                }
            }
            foreach ($parameters as $key => $pvalue) 
            {
                //echo $pvalue->gprs_level_min."=>".$value->gprs_level."=>".$pvalue->gprs_level_max."<br>";
                if($pvalue->gprs_level_min <= $value->gprs_level && $value->gprs_level <= $pvalue->gprs_level_max)
                {
                    $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                    if($color)
                    {
                        $value->gprs_level_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $value->gprs_level_box_class = "red";
                }
            }

            $midlogoff = ETMMidLogoffLog::where('abstract_no', $value->abstract_no)
                        ->whereDate('start_timestamp', DB::raw('CURDATE()'))
                        ->whereNull('end_timestamp')
                        ->first();
            //return $value->abstract_no;response()->json($midlogoff);

            if($midlogoff)
            {   
                $value->last_communicated_box_class = "blue";
            }else {
                foreach ($parameters as $key => $pvalue) 
                {
                    //echo $pvalue->last_communicated_min."=>".$lastCommunicated."=>".$pvalue->last_communicated_max."</br>";
                    if($pvalue->last_communicated_min <= $lastCommunicated && $lastCommunicated <= $pvalue->last_communicated_max)
                    {
                        $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                        if($color)
                        {
                            $value->last_communicated_box_class = $color->class_name;
                            break;
                        }
                    }else {
                        $value->last_communicated_box_class = "red";
                    }
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
                        $value->last_ticket_issued_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $value->last_ticket_issued_box_class = "red";
                }
            }
        }

        return response()->json($statusData);
    }

    /**
    *----------------------------------------------------------------------------------------------------------
    *Show ETM health shatus data by parameters
    *
    *----------------------------------------------------------------------------------------------------------
    */

    public function getETMHealthStatusDataByParameters($depotId, $etmNo, $status = 1)
    {
        $statusData = DB::table('etm_login_log')
                        ->leftJoin('crew as conductor', 'etm_login_log.conductor_id', '=', 'conductor.id')
                        ->leftJoin('shift_start', 'etm_login_log.abstract_no', '=', 'shift_start.abstract_no')
                        ->leftJoin('etm_details', 'etm_login_log.etm_id', '=', 'etm_details.id')
                        ->leftJoin('depots', 'etm_details.depot_id', '=', 'depots.id')
                        ->leftJoin('routes', 'shift_start.route_id', '=', 'routes.id')
                        ->leftJoin('duties', 'shift_start.duty_id', '=', 'duties.id')
                        ->leftJoin('shifts', 'shift_start.shift_id', '=', 'shifts.id')
                        ->leftJoin('vehicles', 'shift_start.vehicle_id', '=', 'vehicles.id')
                        ->leftJoin('crew as driver', 'shift_start.driver_id', '=', 'driver.id');

        //return $statusData;

        if($etmNo)
        {
            $statusData = $statusData->where('etm_login_log.etm_id', $etmNo);
        }

        if($depotId)
        {
            //set the depot ID in the session
            Session::put('depotId', $depotId);
            //return Session::get('depotId');
            $statusData = $statusData->where('etm_details.depot_id', $depotId);
        }
                            
        $statusData = $statusData->select('etm_login_log.gprs_level', 'etm_login_log.battery_percentage', 'etm_login_log.etm_id', 'etm_login_log.abstract_no', 'conductor.crew_name as conductor_name', 'conductor.crew_id as conductor_id', 'conductor.mobile', 'driver.crew_name as driver_name', 'driver.crew_id as driver_id', 'routes.route', 'duties.duty_number', 'shifts.shift', 'vehicles.vehicle_registration_number', 'etm_login_log.login_timestamp', 'etm_login_log.logout_timestamp', 'shift_start.route_id', 'shift_start.duty_id', 'shift_start.shift_id', 'shift_start.vehicle_id', 'conductor.id as conductorId', 'driver.id as driverId')
            ->whereDate('etm_login_log.login_timestamp', DB::raw('CURDATE()'))
            ->get();

        //return $statusData;

        $parameters = DB::table('etm_health_status_params')->get();

        $dataToBeBoradcasted = [];
        $i = 0;

        foreach ($statusData as $key => $value) 
        {
            if($value->abstract_no)
            {
                //match against waybill
                $waybill = Waybill::where('abstract_no', $value->abstract_no)->first();
                if($waybill)
                {
                    if($waybill->etm_no != $value->etm_id || $waybill->abstract_no != $value->abstract_no)
                    {
                        $value->etm_abstract_box_class = "red";
                    }else{
                        $value->etm_abstract_box_class = "";
                    }
                    //echo $waybill->conductor_id . "=>" . $value->conductorId . "=>" . $waybill->driver_id . "=>" . $value->driverId."</br>";
                    if($waybill->conductor_id != $value->conductorId || $waybill->driver_id != $value->driverId)
                    {
                        $value->conductor_driver_box_class = "red";
                    }else{
                        $value->conductor_driver_box_class = "";
                    }

                    if($waybill->route_id != $value->route_id || $waybill->duty_id != $value->duty_id || $waybill->shift_id != $value->shift_id)
                    {
                        $value->route_duty_shift_box_class = "red";
                    }else{
                        $value->route_duty_shift_box_class = "";
                    }

                    if($waybill->vehicle_id != $value->vehicle_id)
                    {
                        $value->bus_box_class = "red";
                    }else{
                        $value->bus_box_class = "";
                    }
                }else{
                    $value->etm_abstract_box_class = "";
                    $value->conductor_driver_box_class = "";                    
                    $value->route_duty_shift_box_class = "";
                    $value->bus_box_class = "";
                }

                $lastTicket = Ticket::where('abstract_id', $value->abstract_no)->orderBy('id', 'desc')->first();
                if($lastTicket)
                {
                    $value->last_ticket_issued = $lastTicket->sold_at;
                    $value->last_communicated = $lastTicket->created_at;

                    $lastCommunicatedSeconds = strtotime($value->last_communicated) / 60;
                    $lastTicketIssuedSeconds = strtotime($value->last_ticket_issued) / 60;
                    $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                    $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;
                    $lastTicketIssued = $nowSeconds - $lastTicketIssuedSeconds;

                    $value->last_communicated = date('Y-m-d H:i:s', strtotime($lastTicket->created_at)) . " (".(int)$lastCommunicated. ")";
                }else{
                    $lastTrip = TripStart::where('abstract_no', $value->abstract_no)->orderBy('id', 'desc')->first();
                    if($lastTrip)
                    {
                        $value->last_ticket_issued = "";
                        $value->last_communicated = $lastTrip->created_at;

                        $lastCommunicatedSeconds = strtotime($value->last_communicated) / 60;
                        $lastTicketIssuedSeconds = "";
                        $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                        $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                        $value->last_communicated = date('Y-m-d H:i:s', strtotime($lastTrip->created_at)) . " (".(int)$lastCommunicated. ")";
                    }else{
                        $value->last_ticket_issued = "";
                        $value->last_communicated = $value->login_timestamp;

                        $lastCommunicatedSeconds = strtotime($value->last_communicated) / 60;
                        $lastTicketIssuedSeconds = "";
                        $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                        $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                        $value->last_communicated = date('Y-m-d H:i:s', strtotime($value->last_communicated)) . " (".(int)$lastCommunicated. ")";
                    }
                }
                
            }else{
                $value->last_ticket_issued = "";
                $value->last_communicated = $value->login_timestamp;

                $lastCommunicatedSeconds = strtotime($value->last_communicated) / 60;
                $lastTicketIssuedSeconds = "";
                $nowSeconds = strtotime(date('Y-m-d H:i:s')) / 60;

                $lastCommunicated = $nowSeconds - $lastCommunicatedSeconds;

                $value->last_communicated = date('Y-m-d H:i:s', strtotime($value->last_communicated)) . " (".(int)$lastCommunicated. ")";
            }

            $value->abstract_number = $value->abstract_no;
            $value->etm_abstract = $value->etm_id." / ". $value->abstract_no;
            if(!$value->etm_id || !$value->abstract_no)
            {
                $value->etm_abstract_box_class = "red";
            }else {
                $value->etm_abstract_box_class = "";
            }
            $value->conductor_driver = $value->conductor_name." (".$value->conductor_id.")"." / ". $value->driver_name." (".$value->driver_id.")";
            $value->login_logout = $value->login_timestamp." / ". $value->logout_timestamp;
            $value->mobile = $value->mobile;
            $value->route_duty_shift = $value->route."-".$value->duty_number."-".$value->shift;
            $value->bus = $value->vehicle_registration_number;

            foreach ($parameters as $key => $pvalue) 
            {
                if($pvalue->battery_percentage_min <= $value->battery_percentage && $value->battery_percentage <= $pvalue->battery_percentage_max)
                {
                    //echo $pvalue->battery_percentage_min."=>".$value->battery_percentage."=>".$pvalue->battery_percentage_max.$pvalue->color_id."</br>";
                    $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                    if($color)
                    {
                        $value->battery_percentage_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $value->battery_percentage_box_class = "red";
                }
            }
            foreach ($parameters as $key => $pvalue) 
            {
                //echo $pvalue->gprs_level_min."=>".$value->gprs_level."=>".$pvalue->gprs_level_max."<br>";
                if($pvalue->gprs_level_min <= $value->gprs_level && $value->gprs_level <= $pvalue->gprs_level_max)
                {
                    $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                    if($color)
                    {
                        $value->gprs_level_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $value->gprs_level_box_class = "red";
                }
            }

            $midlogoff = ETMMidLogoffLog::where('abstract_no', $value->abstract_no)
                        ->whereDate('start_timestamp', DB::raw('CURDATE()'))
                        ->whereNull('end_timestamp')
                        ->first();
            //return $value->abstract_no;response()->json($midlogoff);

            if($midlogoff)
            {   
                $value->last_communicated_box_class = "blue";
            }else {
                foreach ($parameters as $key => $pvalue) 
                {
                    //echo $pvalue->last_communicated_min."=>".$lastCommunicated."=>".$pvalue->last_communicated_max."</br>";
                    if($pvalue->last_communicated_min <= $lastCommunicated && $lastCommunicated <= $pvalue->last_communicated_max)
                    {
                        $color = DB::table('etm_health_status_colors')->where('id', $pvalue->color_id)->first();
                        if($color)
                        {
                            $value->last_communicated_box_class = $color->class_name;
                            break;
                        }
                    }else {
                        $value->last_communicated_box_class = "red";
                    }
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
                        $value->last_ticket_issued_box_class = $color->class_name;
                        break;
                    }
                }else {
                    $value->last_ticket_issued_box_class = "red";
                }
            }
        }

        $dataToBeBoradcasted[$i]['etm_abstract'] = $value->etm_abstract; 
        $dataToBeBoradcasted[$i]['etm_abstract_box_class'] = $value->etm_abstract_box_class; 
        $dataToBeBoradcasted[$i]['conductor_driver'] = $value->conductor_driver; 
        $dataToBeBoradcasted[$i]['conductor_driver_box_class'] = $value->conductor_driver_box_class;
        $dataToBeBoradcasted[$i]['login_logout'] = $value->login_logout; 
        $dataToBeBoradcasted[$i]['mobile'] = $value->mobile; 
        $dataToBeBoradcasted[$i]['route_duty_shift'] = $value->route_duty_shift; 
        $dataToBeBoradcasted[$i]['route_duty_shift_box_class'] = $value->route_duty_shift_box_class; 
        $dataToBeBoradcasted[$i]['bus'] = $value->bus; 
        $dataToBeBoradcasted[$i]['bus_box_class'] = $value->bus_box_class; 
        $dataToBeBoradcasted[$i]['last_communicated'] = $value->last_communicated; 
        $dataToBeBoradcasted[$i]['last_communicated_box_class'] = $value->last_communicated_box_class; 
        $dataToBeBoradcasted[$i]['last_ticket_issued'] = $value->last_ticket_issued; 
        $dataToBeBoradcasted[$i]['last_ticket_issued_box_class'] = $value->last_ticket_issued_box_class;
        $dataToBeBoradcasted[$i]['gprs_level'] = $value->gprs_level;
        $dataToBeBoradcasted[$i]['gprs_level_box_class'] = $value->gprs_level_box_class;
        $dataToBeBoradcasted[$i]['battery_percentage'] = $value->battery_percentage;
        $dataToBeBoradcasted[$i]['battery_percentage_box_class'] = $value->battery_percentage_box_class;

        $broadcastData = ['flag'=>1, 'data'=>$dataToBeBoradcasted];
        $i++;
        //return response()->json($broadcastData);

        event(new ETMDataUpdated($broadcastData));

        return response()->json($statusData);
    }

    /**
    *--------------------------------------------------------------------------------------------------
    *Store mid log
    *
    *--------------------------------------------------------------------------------------------------
    */
    public function startMidLogOff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'abstract_number' => 'required',
            'flag' => 'required',
            'start_timestamp' => 'required_if:flag,1',
            'end_timestamp' => 'required_if:flag,0'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'data'=>$validator->errors()]);
        }

        if($request->flag == 1)
        {
            $log = ETMMidLogoffLog::create(['abstract_no'=>$request->abstract_number, 'start_timestamp'=>date('Y-m-d H:i:s', strtotime($request->start_timestamp))]);
        }else if($request->flag == 0)
        {
            $log = ETMMidLogoffLog::where('abstract_no', $request->abstract_number)
                        ->whereNull('end_timestamp')
                        ->first();

            if($log)
            {
                $log->end_timestamp = date('Y-m-d H:i:s', strtotime($request->end_timestamp));
                $log->save();
            }else{
                return response()->json(['status'=>'Error', 'data'=>'Invalid abstract number!']);
            }
        }else{
            return response()->json(['status'=>'Error', 'data'=>'Invalid flag!']);
        }        

        if($log)
        {
            return response()->json(['status'=>'Ok', 'data'=>'Logoff saved successfully.']);
        }else{
            return response()->json(['status'=>'Error', 'data'=>'Some error occured!']);
        }
    }
}
