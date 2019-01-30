<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Duty;
use App\Models\Waybill;
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

        $data = [];

        foreach ($routes as $key => $route) 
        {
        	foreach ($duties as $key => $duty) 
        	{
        		$queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route->id, $duty->id);

        		$data[$route->id][$duty->id] = $queryBuilder->get();
        	}
        }

        return $data;

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
        $from_date = date('Y-m-d H:i:s', strtotime($input['from_date']));
        $to_date = date('Y-m-d H:i:s', strtotime($input['to_date']));
        $time_slot = $input['time_slot'];
        $route_id = $input['route_id'];
        $direction = $input['direction'];

        $route = Route::where([['route_number', $route_id], ['direction', $direction]])->first();

        if($route)
        {
        	$stopsIds = RouteDetail::where('route_id', $route->id)
        							->get(['stop_id'])
        							->pluck('stop_id')
        							->toArray();
        }else {
        	$stopsIds = [];
        }

        $data = [];
        $stops = [];

        
        $stops = Stop::whereIn('id', $stopsIds)->get();
        

        $incrementSeconds = (int)$time_slot*60;

        for ($i=strtotime($from_date); $i < strtotime($to_date); $i+=$incrementSeconds) 
        { 
        	$slots[] = date('Y-m-d H:i:s', $i); 
        }

        $stops->map(function($value, $key) use($slots, $incrementSeconds, $direction, $from_date, $to_date){
        	$destinations = Ticket::whereHas('waybill', function($query) use($direction){
								        	if($direction)
									        {
									            $query->whereHas('routeNotMaster', function($q) use ($direction){
									            	$q->where('direction', $direction);
									            });
									        }
								        })->where('stage_from', $value->id)
        							  ->where('created_at', '>=', $from_date)
        							  ->where('created_at', '<=', $to_date)
        							  ->groupBy('stage_to')
        							  ->havingRaw('SUM(adults+childs) > 0')
        							  ->with('toStop:id,short_name')
        							  ->get(['stage_to']);
        	$value->destinations = $destinations;
        	foreach ($destinations as $key => $destination) 
        	{
	        	foreach ($slots as $key => $slot) 
	        	{
	        		$slotStart = date('Y-m-d H:i:s', strtotime($slot));
	        		$slotEnd = date('Y-m-d H:i:s', (strtotime($slot)+$incrementSeconds));
	        		$queryBuilder = $this->getQueryBuilder($slotStart, $slotEnd, $value->id, $direction, $destination->toStop->id);
	        		$count = $queryBuilder->first();
	        		$prop = $slot.$destination->toStop->short_name;
	        		$value->$prop = $count->passenger_count ? $count->passenger_count : 0;
	        		$value->destination = $destination->toStop->short_name;
	        	}
	        }

        	return $value;
        });
    
        $title = 'Trip-wise Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Route : ' . $routeName,
            'From : '.date('d-m-Y H:i:s', strtotime($from_date)),
            'To : '.date('d-m-Y H:i:s', strtotime($to_date)),
            'Direction : '.$direction
        ]; 

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'stops'=>$stops, 'slots'=>$slots, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
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
        $queryBuilder = Waybill::->withCount(['tickets as tickets_count'=>function($query){
						        	$query->where('ticket_type', 'Ticket');
						        }])->withCount(['tickets as pass_count'=>function($query){
						        	$query->where('ticket_type', 'Pass')
						        		  ->orWhere('ticket_type', 'ETMPass');
						        }])->withCount(['tickets as epurse_count'=>function($query){
						        	$query->where('ticket_type', 'EPurse');
						        }])->withCount(['tickets as cash_passenger_count'=>function($query){
						        	$query->select(DB::raw("(SUM(adults) + SUM(childs))"))
						        		  ->where('ticket_type', 'Ticket');
						        }])->withCount(['tickets as card_passenger_count'=>function($query){
						        	$query->select(DB::raw("(SUM(adults) + SUM(childs))"))
						        		  ->where('ticket_type', 'Pass')
						        		  ->orWhere('ticket_type', 'ETMPass');
						        }])->withCount(['tickets as epurse_passenger_count'=>function($query){
						        	$query->select(DB::raw("(SUM(adults) + SUM(childs))"))
						        		  ->where('ticket_type', 'EPurse');
						        }])->with(['route:id,route_name', 'duty:id,duty_number', 'conductor:id,crew_name,crew_id', 'driver:id,crew_name,crew_id', 'etm:id,etm_no', 'vehicle:id,vehicle_registration_number', 'trips.fromStop:id,short_name', 'trips.toStop:id,short_name'])
        						->where('depot_id', $depot_id);
        
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
}
