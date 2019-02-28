<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Fare;
use App\Models\Trip;
use App\Models\Route;
use App\Models\Ticket;
use App\Models\Target;
use App\Models\TripStart;
use App\Models\TripDetail;
use App\Traits\activityLog;
use App\Models\CenterStock;
use App\Models\RouteDetail;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class ScheduleWiseEPKMController extends Controller
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
        return view('reports.revenue.schedule_wise_epkm.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $route_id = $input['route_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route_id);

        $data = $queryBuilder->paginate(10);

        $data->getCollection()->transform(function($value){
        	$trip = Trip::where([['route_id', $value->route_master_id], ['duty_id', $value->waybill->duty->id], ['shift_id', $value->waybill->shift->id]])->first();
        	if($trip)
        	{
        		$tripDetails = TripDetail::where([['trip_id', $trip->id], ['trip_no', $value->trip_id]])->first();
        		if($tripDetails)
        		{
        			$value->schedule_time = $tripDetails->start_time;
        		}
        	}else{
        		$value->schedule_time = 'N/A';
        	}

        	$target = Target::where([['route_id', $value->route_master_id], ['duty_id', $value->waybill->duty->id], ['shift_id', $value->waybill->shift->id], ['trip', $value->trip_id]])->first();

        	if($target)
        	{
        		$value->target_epkm = $target->epkm;
        		$value->target_income = $target->income;
        	}else{
        		$value->target_epkm = 0;
        		$value->target_income = 0;
        	}

        	$tickets = Ticket::where([['abstract_id', $value->abstract_no], ['trip_id', $value->trip_id]])
        					   ->select(DB::raw("(SUM(childs)+SUM(adults)) as passenger_count, SUM(total_amt) as actual_income, COUNT(*) as tickets_count"))
        					   ->get();
        	$value->tickets = $tickets;

        	$route = Route::where([['route_number', $value->route_master_id], ['direction', $value->direction]])->first();
        	if($route)
        	{
        		$stage = RouteDetail::where('route_id', $route->id)->max('stage_number');

        		if($stage)
        		{
        			$fare = Fare::where([['service_id', $value->service_id], ['stage', $stage]])->first();
        			if($fare)
        			{
        				$value->actual_epkm = calculateEPKM($fare->adult_ticket_amount, $value->route->distance, $value->waybill->vehicle->seating_capacity);
        			}else{
        				$value->actual_epkm = 0;
        			} 
        		}else{
        			$value->actual_epkm = 0;
        		}

        		$value->routeDetails = $routeDetails;
        	}else{
        		$value->actual_epkm = 0;
        	}

        	$value->load_factor = calculateLoadFactor($value->actual_epkm, $value->target_epkm);

        	return $value;
        });

        //return $data;

        return view('reports.revenue.schedule_wise_epkm.index', compact('data'));
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
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $etm_no = $input['etm_no'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no);
        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Schedule-wise EPKM Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'ETM Number : '.$etm_no
        ];   

        $reportData = $queryBuilder->get();  

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $etm_no = $input['etm_no'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $title = 'Schedule-wise EPKM Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'ETM Number : ' => $etm_no,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 
      
        $columns = [
                        'Date'=> function($row){
                            return date('d-m-Y', strtotime($row->created_at));
                        },
                        'ETM Number'=> function($row){
                            return $row->etm->etm_no;
                        },
                        'Route'=> function($row){
                            return $row->route->route_name;
                        },
                        'Duty' => function($row){
                            return $row->duty->duty_number;
                        }, 
                        'Ticket Count' => function($row){
                            return $row->tickets_count;
                        }, 
                        'Pass Count' => function($row){
                            return $row->pass_count;
                        }, 
                        'EPurse Count' => function($row){
                            return $row->epurse_count;
                        }, 
                        'Passenger (Cash)' => function($row){
                            return $row->cash_passenger_count ? $row->cash_passenger_count : '0';
                        }, 
                        'Passenger (Pass)' => function($row){
                            return $row->card_passenger_count ? $row->card_passenger_count : '0';
                        }, 
                        'Passenger (EPurse)' => function($row){
                            return $row->epurse_passenger_count ? $row->epurse_passenger_count : '0';
                        }, 
                        'Concession' => function($row){
                            return calculateConcession($row->tickets);
                        }];

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
        					->editColumns(['Ticket Count', 'Pass Count', 'EPurse Count', 'Passenger (Cash)', 'Passenger (Pass)', 'Passenger (EPurse)', 'Concession'], [
		                        'class' => 'right',
		                    ])->download($title.'.xlsx');        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $route_id)
    {
        $queryBuilder = TripStart::whereHas('waybill', function($query) use($depot_id, $route_id){
        		if($depot_id)
		        {
		        	$query->where('depot_id', $depot_id);
		        }
        		if($route_id)
		        {
		        	$query->where('route_id', $route_id);
		        }
        	})->with(['waybill:abstract_no,route_id,duty_id,shift_id,vehicle_id', 'fromStop:id,short_name', 'toStop:id,short_name', 'waybill.vehicle:id,seating_capacity', 'route']);

        if($from_date && $to_date)
		{
		    $queryBuilder->whereDate('start_timestamp', '>=', $from_date)
		                 ->whereDate('start_timestamp', '<=', $to_date);
		}

        return $queryBuilder;
    }
}
