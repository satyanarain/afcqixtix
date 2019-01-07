<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Crew;
use App\Models\Depot;
use App\Models\Waybill;
use App\Models\Inspection;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class PenaltyTicketDetailsController extends Controller
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
        //$duty_id = $input['duty_id'];
        //$shift_id = $input['shift_id'];
        $inspector_id = $input['inspector_id'];
    
        $data = Inspection::with(['route:id,route_name', 'stop:id,stop', 'remark:id,remark_description', 'inspector:id,crew_name', 'conductor:id,crew_name']);

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->orderBy('id', 'ASC')
        			 ->paginate(10);

        //return response()->json($data);

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
        //$duty_id = $input['duty_id'];
        //$shift_id = $input['shift_id'];
        $inspector_id = $input['inspector_id'];
    
        $data = Inspection::with(['route:id,route_name', 'stop:id,stop', 'remark:id,remark_description', 'inspector:id,crew_name', 'conductor:id,crew_name']);

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->orderBy('id', 'ASC');

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

        $reportData = $data->get();      

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
        //$duty_id = $input['duty_id'];
        //$shift_id = $input['shift_id'];
        $inspector_id = $input['inspector_id'];
    
        $data = Inspection::with(['route:id,route_name', 'stop:id,stop', 'remark:id,remark_description', 'inspector:id,crew_name', 'conductor:id,crew_name']);

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->orderBy('id', 'ASC');

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
            'Depot : ' => $depotName,
            'Route : ' => $routeName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 

      
        $columns = [
                        'Inspection Date - Time'=> function($row){
                            return date('d-m-Y H:i:s', strtotime($row->cancellation_timestamp));
                        },
                        'Inspector'=> function($row){
                            return $row->inspector->crew_name;
                        },
                        'Route'=> function($row){
                            return $row->route->route_name;
                        },
                        'Direction' => function($row){
                            return $row->direction;
                        }, 
                        'Panalty Amount' => function($row){
                            return $row->penalty_amount;
                        }, 
                        'Passenger' => function($row){
                            return $row->passenger->crew_name;
                        }, 
                        'Stop' => function($row){
                            return $row->stop->stop;
                        }, 
                        'Conductor' => function($row){
                            return $row->conductor->crew_name;
                        }, 
                        'Remark' => function($row){
                            return $row->remark->remark_description;
                        }];

        return ExcelReport::of($title, $meta, $data, $columns)
        					->download($title.'.xlsx');        
    }
}
