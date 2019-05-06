<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use App\Models\Crew;
use App\Models\Inspection;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class PenaltyTicketDetailsController extends Controller
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
        $inspectors = Crew::where('role', 'Inspector')->pluck('crew_name', 'id');
        return view('reports.etm.penalty_ticket_details.index', compact('inspectors'));
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $route_id = $input['route_id'];
        $inspector_id = $input['inspector_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route_id, $inspector_id);

        $data = $queryBuilder->paginate(10);

        $inspectors = Crew::where('role', 'Inspector')->pluck('crew_name', 'id');

        return view('reports.etm.penalty_ticket_details.index', compact('data', 'inspectors'));
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
        $inspector_id = $input['inspector_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route_id, $inspector_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Penalty Ticket Details Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date))
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
        $route_id = $input['route_id'];
        $inspector_id = $input['inspector_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route_id, $inspector_id);
        $data = $queryBuilder->get();

        //return $queryBuilder->get();

        $depotName = $this->findNameById('depots', 'name', $depot_id);

        if($route_id)
        {
        	$routeName = $this->findNameById('route_master', 'route_name', $route_id);
        }else{
        	$routeName = 'All';
        }
    
        $title = 'Penalty Ticket Details Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Route : ' . $routeName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ];

        $reportColumns = ['S. No', 'Inspection Date - Time', 'Inspector', 'Route', 'Direction', 'Panalty Amount', 'Passenger', 'Stop', 'Conductor', 'Remark'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)date('d-m-Y H:i:s', strtotime($d->cancellation_timestamp)), (string)$d->inspector->crew_name, (string)$d->route->route_name, (string)$d->direction, (string)$d->penalty_amount, (string)$d->name_of_passenger, (string)$d->stop->stop, (string)$d->conductor->crew_name, (string)$d->remark->remark_description]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName);   

        unlink($fileName);     
    }


    public function getQueryBuilder($depot_id, $from_date, $to_date, $route_id, $inspector_id)
    {
        $queryBuilder = Inspection::whereHas('inspector', function($query) use ($depot_id){
                                        $query->where('depot_id', $depot_id);
                                    })->with(['route:id,route_name', 'stop:id,stop', 'remark:id,remark_description', 'inspector:id,crew_name', 'conductor:id,crew_name']);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }

        if($route_id)
        {
            $queryBuilder = $queryBuilder->where('route_id', $route_id);
        }

        if($inspector_id)
        {
            $queryBuilder = $queryBuilder->where('inspector_id', $inspector_id);                
        }

        $queryBuilder = $queryBuilder->orderBy('id', 'ASC');

        return $queryBuilder;
    }
}
