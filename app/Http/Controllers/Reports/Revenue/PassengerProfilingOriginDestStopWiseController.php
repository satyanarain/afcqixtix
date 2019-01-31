<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Stop;
use App\Models\Route;
use App\Models\Ticket;
use App\Models\RouteDetail;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class PassengerProfilingOriginDestStopWiseController extends Controller
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
        return view('reports.revenue.passenger_profiling_origin_dest_stop_wise.index');
    }

    public function displayData(Request $request)
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

        
        $stops = Stop::whereIn('id', $stopsIds)->paginate(10);
        

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

        //return $stops;

        return view('reports.revenue.passenger_profiling_origin_dest_stop_wise.index', compact('slots', 'stops'));
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
    
        $title = 'Passenger Profiling Origin Destination Stop-wise Report'; // Report title

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
        $title = 'Passenger Profiling Origin Destination Stop-wise Report'; // Report title

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

    public function getQueryBuilder($from_date, $to_date, $stop_id, $direction, $destId)
    {
        $queryBuilder = Ticket::whereHas('waybill', function($query) use($direction){
        	if($direction)
	        {
	            $query->whereHas('routeNotMaster', function($q) use ($direction){
	            	$q->where('direction', $direction);
	            });
	        }
        })->where([['stage_from', $stop_id], ['stage_to', $destId]]);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->where('sold_at', '>=', $from_date)
                                         ->where('sold_at', '<=', $to_date);
        }

        return $queryBuilder->select(DB::raw("(SUM(childs)+SUM(adults)) as passenger_count"));
    }
}
