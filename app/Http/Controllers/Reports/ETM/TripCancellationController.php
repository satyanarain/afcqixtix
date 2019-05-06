<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use Validator;
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
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;


class TripCancellationController extends Controller
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
            'Depot : ' . ucfirst($depotName),
            'Route : ' . $routeName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Time', 'Route', 'Duty', 'Shift', 'Bus No.', 'Conductor', 'Trip No.', 'Stop', 'Reason'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)date('H:i:s', strtotime($d->cancellation_timestamp)), (string)$d->wayBill->route->route_name, (string)$d->wayBill->duty->duty_number, (string)$d->wayBill->shift->shift, (string)$d->wayBill->vehicle->vehicle_registration_number, (string)$d->wayBill->conductor->crew_name.' ('.$d->wayBill->conductor->crew_name.')', (string)$d->trip_no, (string)$d->stop ? $d->stop->stop : 'N/A', (string)$d->reason->reason_description]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);     
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
