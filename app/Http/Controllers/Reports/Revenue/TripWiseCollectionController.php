<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Trip;
use App\Models\Duty;
use App\Models\Route;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\TripDetail;
use App\Models\RouteMaster;
use App\Models\RouteDetail;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class TripWiseCollectionController extends Controller
{
    use activityLog;
    use checkPermission;

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
        $from_date = date('Y-m-d H:i:s', strtotime($input['from_date']));
        $to_date = date('Y-m-d H:i:s', strtotime($input['to_date']));
        $time_slot = $input['time_slot'];
        $stop_id = $input['stop_id'];
        $direction = $input['direction'];

        $stopName = $this->findNameById('stops', 'short_name', $stop_id);

        $stopName = $stopName ? $stopName : 'All';

        $data = [];
        $stops = [];

        if(!$stop_id)
        {
        	$stops = Stop;
        }else{
        	$stops = Stop::where('id', $stop_id);
        }

        $incrementSeconds = (int)$time_slot*60;

        for ($i=strtotime($from_date); $i < strtotime($to_date); $i+=$incrementSeconds) 
        { 
        	$slots[] = date('Y-m-d H:i:s', $i); 
        }
        $title = 'Trip-wise Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Stop : ' => $stopName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date)),
            'Direction : '=>$direction
        ]; 

        $stops->map(function($value, $key) use($slots, $incrementSeconds, $direction){
        	foreach ($slots as $key => $slot) 
        	{
        		$slotStart = date('Y-m-d H:i:s', strtotime($slot));
        		$slotEnd = date('Y-m-d H:i:s', (strtotime($slot)+$incrementSeconds));
        		$queryBuilder = $this->getQueryBuilder($slotStart, $slotEnd, $value->id, $direction);
        		$count = $queryBuilder->first();
        		$value->$slot = $count->passenger_count ? $count->passenger_count : 0;
        	}

        	return $value;
        });
      
        $columns = [
                        'Stop'=> function($row){
                            return $row->short_name;
                        }];
        foreach ($slots as $key => $slot) 
        {
        	array_push($columns, $slot);
        }

        //return $columns;
        return ExcelReport::of($title, $meta, $stops, $columns)
        					->download($title.'.xlsx');        
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
