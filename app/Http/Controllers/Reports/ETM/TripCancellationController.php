<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Crew;
use App\Models\Shift;
use App\Models\Depot;
use App\Models\Waybill;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Models\AuditInventory;
use App\Traits\checkPermission;
use App\Models\TripCancellation;
use App\Http\Controllers\Controller;


class TripCancellationController extends Controller
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
        return view('reports.etm.trip_cancellation.index');
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

        return view('reports.etm.trip_cancellation.index', compact('data'));
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
    
        $title = 'Trip Cancellation - Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date))
        ];   

        $reportData = $queryBuilder->get();      

        //return $reportData;

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
        if($route_id)
        {
        	$routeName = $this->findNameById('route_master', 'route_name', $route_id);
        }else{
        	$routeName = 'All';
        }
    
        $title = 'Trip Cancellation - Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Route : ' => $routeName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 
      
        $columns = [
                        'Time'=> function($row){
                            return date('H:i:s', strtotime($row->cancellation_timestamp));
                        },
                        'Route'=> function($row){
                            return $row->wayBill->route->route_name;
                        },
                        'Duty' => function($row){
                            return $row->wayBill->duty->duty_number;
                        }, 
                        'Shift' => function($row){
                            return $row->wayBill->shift->shift;
                        }, 
                        'Bus No.' => function($row){
                            return $row->wayBill->vehicle->vehicle_registration_number;
                        }, 
                        'Conductor' => function($row){
                            return $row->wayBill->conductor->crew_name.' ('.$row->wayBill->conductor->crew_name.')';
                        }, 
                        'Trip No.' => function($row){
                            return $row->trip_no;
                        }, 
                        'Stop' => function($row){
                            return $row->stop ? $row->stop->stop : 'N/A';
                        }, 
                        'Reason' => function($row){
                            return $row->reason->reason_description;
                        }];

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
        					->download($title.'.xlsx');        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $route_id)
    {
        $queryBuilder = TripCancellation::whereHas('wayBill', function($query) use ($depot_id, $route_id){
                if($depot_id)
                {
                    $query->where('depot_id', $depot_id);
                }
                if($route_id)
                {
                    $query->where('route_id', $route_id);
                }
            })->with(['wayBill.route', 'wayBill.duty', 'wayBill.shift', 'wayBill.vehicle', 'wayBill.conductor', 'stop:id,stop', 'reason:id,reason_description']);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }
                
        $queryBuilder = $queryBuilder->orderBy('id', 'ASC');

        return $queryBuilder;
    }
}
