<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Stop;
use App\Models\Ticket;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class PassengerProfilingStopWiseController extends Controller
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
        return view('reports.revenue.passenger_profiling_stop_wise.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $from_date = date('Y-m-d H:i:s', strtotime($input['from_date']));
        $to_date = date('Y-m-d H:i:s', strtotime($input['to_date']));
        $time_slot = $input['time_slot'];
        $stop_id = $input['stop_id'];
        $direction = $input['direction'];

        $data = [];
        $stops = [];

        if(!$stop_id)
        {
        	$stops = Stop::paginate(10);
        }else{
        	$stops = Stop::where('id', $stop_id)->paginate(10);
        }

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

        return view('reports.revenue.passenger_profiling_stop_wise.index', compact('slots', 'stops'));
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
        $stop_id = $input['stop_id'];
        $direction = $input['direction'];

        $stopName = $this->findNameById('stops', 'short_name', $stop_id);

        $stopName = $stopName ? $stopName : 'All';

        $data = [];
        $stops = [];

        if(!$stop_id)
        {
        	$stops = Stop::get();
        }else{
        	$stops = Stop::where('id', $stop_id)->get();
        }

        $incrementSeconds = (int)$time_slot*60;

        for ($i=strtotime($from_date); $i < strtotime($to_date); $i+=$incrementSeconds) 
        { 
        	$slots[] = date('Y-m-d H:i:s', $i); 
        }
    
        $title = 'Passenger Profiling Stop-wise Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Stop : ' . $stopName,
            'From : '.date('d-m-Y H:i:s', strtotime($from_date)),
            'To : '.date('d-m-Y H:i:s', strtotime($to_date)),
            'Direction : '.$direction
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
        $title = 'Passenger Profiling Stop-wise Report'; // Report title

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

    public function getQueryBuilder($from_date, $to_date, $stop_id, $direction)
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
}
