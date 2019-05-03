<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;
use App\Models\{TripStart, Trip, Target, Ticket, Route};

class EPKMController extends Controller
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
        return view('reports.revenue.epkm.index');
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

        $data = $this->getData($data);

        return view('reports.revenue.epkm.index', compact('data'));
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
        $route_id = $input['route_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route_id);
        $depotName = $this->findNameById('depots', 'name', $depot_id);  
        $routeName =  $this->findNameById('route_master', 'route_name', $route_id);
        $routeName = $routeName ? $routeName : 'All';   
        $title = 'EPKM for Route Trip-wise Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'Route : ' . $routeName
        ];   
        $data = $queryBuilder->paginate(100);
        $reportData = $this->getData($data);  

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $route_id = $input['route_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route_id);
        $depotName = $this->findNameById('depots', 'name', $depot_id);  
        $routeName =  $this->findNameById('route_master', 'route_name', $route_id);
        $routeName = $routeName ?? 'All';   
        $title = 'EPKM for Route Trip-wise Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'Route : ' . $routeName
        ];   

        $data = $queryBuilder->paginate(100);

        $data = $this->getData($data); 

        $reportColumns = ['S. No', 'Duty', 'Trip No.', 'From Stop', 'To Stop', 'Direction', 'Sch. Trip Time', 'Distance (Kms)', 'Operated', 'Operated Distance', 'Target Income', 'Actual Income', 'Target EPKM', 'Actual EPKM', 'Passengers', 'Tickets', 'Load Factor'];

        $reportData = [];
        array_push($reportData, $reportColumns);
        foreach ($data as $key => $rdata) 
        {
            $duty_number = $rdata->waybill->duty->duty_number;
            $trip_id = $rdata->trip_id;
            $fromStop = $rdata->fromStop->short_name;
            $toStop = $rdata->toStop->short_name;
            $direction = $rdata->direction;
            $schedule_time = $rdata->schedule_time;
            $distance = number_format((float)$rdata->route->distance, 2, '.', '');
            $operated = '0';
            $operatedDistance = '0';
            $target_income = number_format((float)$rdata->target_income, 2, '.', '');
            $actual_income = number_format((float)$rdata->tickets[0]->actual_income, 2, '.', '');
            $target_epkm = number_format((float)$rdata->target_epkm, 2, '.', '');
            $actual_epkm = number_format((float)$rdata->actual_epkm, 2, '.', '');
            $passenger_count = $rdata->tickets[0]->passenger_count;
            $tickets_count = $rdata->tickets[0]->tickets_count;
            $load_factor = number_format((float)$rdata->load_factor, 2, '.', '');

            array_push($reportData, [(string)($key+1), $duty_number, (string)$trip_id, (string)$fromStop, (string)$toStop, (string)$direction, (string)$schedule_time, (string)$distance, (string)$operated, (string)$operatedDistance, (string)$target_income, (string)$actual_income, (string)$target_epkm, (string)$actual_epkm, (string)$passenger_count, (string)$tickets_count, (string)$load_factor]);
        }

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);          
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

    public function getData($data)
    {
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

                $route = Route::where([['route_master_id', $value->route_master_id], ['direction', $value->direction]])->first();
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

        return $data;
    }
}
