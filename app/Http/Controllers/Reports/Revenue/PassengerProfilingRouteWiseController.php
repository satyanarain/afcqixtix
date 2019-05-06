<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;
use App\Models\{RouteDetail, Route, Stop, Ticket};

class PassengerProfilingRouteWiseController extends Controller
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
        return view('reports.revenue.passenger_profiling_route_wise.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $from_date = date('Y-m-d H:i:s', strtotime($input['from_date']));
        $to_date = date('Y-m-d H:i:s', strtotime($input['to_date']));
        $time_slot = $input['time_slot'];
        $route_id = $input['route_id'];
        $direction = $input['direction'];

        $route = Route::where([['route_master_id', $route_id], ['direction', $direction]])->first();

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

        //return $stops;

        return view('reports.revenue.passenger_profiling_route_wise.index', compact('slots', 'stops'));
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

        $routeName = $this->findNameById('route_master', 'route_name', $route_id);
        $routeName = $routeName ? $routeName : 'All';
        $title = 'Passenger Profiling Route-wise Report'; // Report title

        $incrementSeconds = (int)$time_slot*60;

        for ($i=strtotime($from_date); $i < strtotime($to_date); $i+=$incrementSeconds) 
        { 
        	$slots[] = date('Y-m-d H:i:s', $i); 
        }

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Route : ' . $routeName,
            'From : '. date('d-m-Y', strtotime($from_date)),
            'To : '. date('d-m-Y', strtotime($to_date)),
            'Direction : '.$direction
        ];   

        $stops = $this->getData($route_id, $direction, $incrementSeconds, $slots); 

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'stops'=>$stops, 'slots'=>$slots, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $from_date = date('Y-m-d H:i:s', strtotime($input['from_date']));
        $to_date = date('Y-m-d H:i:s', strtotime($input['to_date']));
        $time_slot = $input['time_slot'];
        $route_id = $input['route_id'];
        $direction = $input['direction'];

        $routeName = $this->findNameById('route_master', 'route_name', $route_id);
        $routeName = $routeName ? $routeName : 'All';
        $title = 'Passenger Profiling Route-wise Report'; // Report title


        $incrementSeconds = (int)$time_slot*60;
        $slots = [];
        $reportColumns = [];
        $reportData = [];
        $reportColumns[] = 'S. No.';
        $reportColumns[] = 'Stop';

        for ($i=strtotime($from_date); $i < strtotime($to_date); $i+=$incrementSeconds) 
        { 
            $slots[] = date('Y-m-d H:i:s', $i); 
            $reportColumns[] = substr(date('Y-m-d H:i:s', $i), 11, 5);
        }      

        $reportColumns[] = 'Total';   
        array_push($reportData, $reportColumns);

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

        $data = $this->getData($route_id, $direction, $incrementSeconds, $slots);  

        foreach ($data as $key => $stop) 
        {
            $row = [];
            $row[] = $key+1; 
            $row[] = $stop->short_name;
            $totalCount = 0;
            foreach($slots as $key=>$slot)
            {
                $count = $stop->$slot;
                $row[] = (string)$count;
                $totalCount += (int)$count;
            }
            $row[] = (string)$totalCount;

            array_push($reportData, $row);
        }

        //return $reportData;

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);   
    }

    public function getQueryBuilder($from_date, $to_date, $route_id, $direction)
    {
        $queryBuilder = Ticket::whereHas('waybill', function($query) use($direction, $depot_id){
        	if($direction)
	        {
	            $query->whereHas('routeNotMaster', function($q) use ($direction){
	            	$q->where('direction', $direction);
	            });
	        }
        })->where('stage_from', $stop_id);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->where('sold_at', '>=', $from_date)
                                         ->where('sold_at', '<=', $to_date);
        }

        return $queryBuilder->select(DB::raw("(SUM(childs)+SUM(adults)) as passenger_count"));
    }

    public function getData($route_id, $direction, $incrementSeconds, $slots)
    {
        $route = Route::where([['route_master_id', $route_id], ['direction', $direction]])->first();

        if($route)
        {
            $stopsIds = RouteDetail::where('route_id', $route->id)
                                    ->get(['stop_id'])
                                    ->pluck('stop_id')
                                    ->toArray();
        }else {
            $stopsIds = [];
        }

        $stops = [];
        $stops = Stop::whereIn('id', $stopsIds)->get();  

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

        return $stops;
    }
}
