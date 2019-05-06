<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;
use App\Models\{RouteMaster, Duty, Waybill, Ticket, Route, Trip};

class TripWiseCollectionController extends Controller
{
    use activityLog;
    use checkPermission;
    use GenerateExcelTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.revenue.trip_wise_collection.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d H:i:s', strtotime($input['from_date']));
        $to_date = date('Y-m-d H:i:s', strtotime($input['to_date']));
        $route_id = $input['route_id'];
        $duty_id = $input['duty_id'];        

        $data = $this->getCalculatedData($depot_id, $from_date, $to_date, $route_id, $duty_id, 'display');

        return view('reports.revenue.trip_wise_collection.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPdfReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d H:i:s', strtotime($input['from_date']));
        $to_date = date('Y-m-d H:i:s', strtotime($input['to_date']));
        $route_id = $input['route_id'];
        $duty_id = $input['duty_id'];   

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $routeName = $this->findNameById('route_master', 'route_name', $route_id);     
        $routeName = $routeName ? $routeName : 'All';
        $dutyName = $this->findNameById('duties', 'duty_number', $duty_id);     
        $dutyName = $dutyName ? $dutyName : 'All';
        $data = $this->getCalculatedData($depot_id, $from_date, $to_date, $route_id, $duty_id, 'pdf');
    
        $title = 'Trip-wise Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Route : ' . $routeName,
            'From : '.date('d-m-Y H:i:s', strtotime($from_date)),
            'To : '.date('d-m-Y H:i:s', strtotime($to_date)),
            'Duty : '.$dutyName
        ]; 

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$data, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d H:i:s', strtotime($input['from_date']));
        $to_date = date('Y-m-d H:i:s', strtotime($input['to_date']));
        $route_id = $input['route_id'];
        $duty_id = $input['duty_id'];   

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $routeName = $this->findNameById('route_master', 'route_name', $route_id);     
        $routeName = $routeName ? $routeName : 'All';
        $dutyName = $this->findNameById('duties', 'duty_number', $duty_id);     
        $dutyName = $dutyName ? $dutyName : 'All';
        $data = $this->getCalculatedData($depot_id, $from_date, $to_date, $route_id, $duty_id, 'pdf');
    
        $title = 'Trip-wise Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Route : ' . $routeName,
            'From : '.date('d-m-Y H:i:s', strtotime($from_date)),
            'To : '.date('d-m-Y H:i:s', strtotime($to_date)),
            'Duty : '.$dutyName
        ]; 

        $reportColumns = ['S. No', 'Trip No.', 'From Stop', 'To Stop', 'Schld. Time', 'Trip Start Time', 'Trip End Time', 'Psngr Count', 'Total Amount', 'Ticket Count', 'Ticket Amount', 'Pass Count', 'Pass Amount', 'EPurse Count', 'EPurse Amount', 'Conc', 'Kms'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            $reportColumns = [$d->route->route_name, "Duty - ".$d->duty->duty_number, "Crew - ".$d->conductor->crew_name.' ('.$d->conductor->crew_id.')', "ETM - ".$d->etm->etm_no, "Vehicle No. - ".$d->vehicle->vehicle_registration_number, "Driver - ".$d->driver->crew_name.' ('.$d->driver->crew_id.')', ''];
            array_push($reportData, $reportColumns);

            $trips = $d->trips;
            foreach($trips as $keyi=>$trip)
            {                                  
                $trip_id = $trip->trip_id;
                $fromStop = $trip->fromStop->short_name;
                $toStop = $trip->toStop->short_name;
                $schedule_time = $trip->schedule_time;
                $start_timestamp = date('d-m-Y H:i:s', strtotime($trip->start_timestamp));
                $end_timestamp = date('d-m-Y H:i:s', strtotime($trip->end_timestamp));   
                                    
                $counts = $trip->counts;
                $passengersCount = 0;
                $totalAmount = 0;
                $concessionAmount = 0;
                $ticketCount = 0;
                $ticketAmount = 0;
                $passCount = 0;
                $passAmount = 0;
                $epurseCount = 0;
                $epurseAmount = 0;

                foreach($counts as $keyc=>$count)
                {
                    $passengersCount += $count->passenger_count;
                    $totalAmount += $count->ticket_amount;
                    $concessionAmount += $count->concession_amount;
                    if($count->ticket_type == 'Ticket')
                    {
                        $ticketCount += $count->passenger_count;
                        $ticketAmount += $count->ticket_amount;
                    }
                                            

                    if($count->ticket_type == 'Pass' || $count->ticket_type == 'ETMPass')
                    {
                        $passCount += $count->passenger_count;
                        $passAmount += $count->ticket_amount;
                    }

                    if($count->ticket_type == 'EPurse')
                    {
                        $epurseCount += $count->passenger_count;
                        $epurseAmount += $count->ticket_amount;
                    }
                }

                $totalAmount = number_format((float)$totalAmount, 2, '.', '');
                $ticketAmount = number_format((float)$ticketAmount, 2, '.', '');
                $passAmount = number_format((float)$passAmount, 2, '.', '');
                $epurseAmount = number_format((float)$epurseAmount, 2, '.', '');
                $concessionAmount = number_format((float)$concessionAmount, 2, '.', '');
                $distance = number_format((float)$trip->distance, 2, '.', '');
        
                array_push($reportData, [(string)($key+1), (string)$trip_id, (string)$fromStop, (string)$toStop, (string)$schedule_time, (string)$start_timestamp, (string)$end_timestamp, (string)$passengersCount, (string)$totalAmount, (string)$ticketCount, (string)$ticketAmount, (string)$passCount, (string)$epurseCount, (string)$epurseAmount, (string)$concessionAmount, (string)$distance]);
            }
        } 

        //return $reportData;

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);      
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $route_id, $duty_id)
    {
        $queryBuilder = Waybill::with(['trips.fromStop:id,short_name', 'trips.toStop:id,short_name', 'route:id,route_name', 'duty:id,duty_number', 'conductor:id,crew_name,crew_id', 'driver:id,crew_name,crew_id', 'etm:id,etm_no', 'vehicle:id,vehicle_registration_number'])->where('depot_id', $depot_id);
        
        if($route_id)
        {
        	$queryBuilder = $queryBuilder->where('route_id', $route_id);
        }

        if($duty_id)
        {
        	$queryBuilder = $queryBuilder->where('duty_id', $duty_id);
        }        						

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->where('created_at', '>=', $from_date)
                                         ->where('created_at', '<=', $to_date);
        }

        return $queryBuilder;
    }

    public function getCountsQueryBuilder($abstract_id, $trip_id)
    {
    	$countsQueryBuilder = Ticket::select(DB::raw("ticket_type, (SUM(adults)+SUM(childs)) as passenger_count, (SUM(total_amt)) as ticket_amount, SUM(concession_amt) as concession_amount"))->groupBy('ticket_type')
    					    ->where([['abstract_id', $abstract_id], ['trip_id', $trip_id]]);

		return $countsQueryBuilder;
    }

    public function getCalculatedData($depot_id, $from_date, $to_date, $route_id, $duty_id, $flag='display')
    {
    	if($route_id)
        {
        	$routes = RouteMaster::whereId($route_id)->get(['id']);
        }else {
        	$routes = RouteMaster::get(['id']);
        }

        if($duty_id)
        {
        	$duties = Duty::whereId($duty_id)->get(['id']);
        }else {
        	$duties = Duty::get(['id']);
        }

        foreach ($routes as $key => $route) 
        {
        	foreach ($duties as $key => $duty) 
        	{
        		$queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route->id, $duty->id);
        		if($flag == 'display')
        		{
        			$waybills =  $queryBuilder->paginate(1);
        		}else if($flag == 'pdf'){
        			$waybills =  $queryBuilder->get();
        		}else{
        			$waybills =  $queryBuilder->paginate(1);
        		}
        		
		        foreach ($waybills as $key => $waybill) 
		        {
		        	$trips = $waybill->trips;
		        	foreach ($trips as $key => $trip) 
		        	{
		        		$countsQueryBuilder = $this->getCountsQueryBuilder($waybill->abstract_no, $trip->trip_id);

        				$trip->counts = $countsQueryBuilder->get();
        				$r = Route::where([['source', $trip->start_stop_id], ['destination', $trip->end_stop_id]])->first();
        				if($r)
        				{
        					$trip->distance = $r->distance;
        				}else {
        					$trip->distance = 0;
        				}
        				$trip_no = $trip->trip_id;
        				$tripData = Trip::with(['tripDetail' => function($query) use($trip_no){
        					$query->where('trip_no', $trip_no)
        						  ->select('trip_id', 'trip_no', 'start_time');
        				}])->where([['route_id', $waybill->route_id], ['duty_id', $waybill->duty_id], ['shift_id', $waybill->shift_id]])->first();
        				$trip->schedule_time = $tripData->tripDetail->start_time;
		        	}
		        }
        		
        	}
        }

        return $waybills;
    }
}
