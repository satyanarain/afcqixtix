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
use App\Traits\checkPermission;
use App\Models\ReturnCrewStock;
use App\Http\Controllers\Controller;

class AuditStatusController extends Controller
{
    use checkPermission;
    use activityLog;
    protected $crewstock;

    /**
     * Index function created for create report form.
     * Created By satya
     * Date 12-12-2018
     */
    public function index()
    {
        return view('reports.etm.audit_status.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created report.
     * Created By satya
     * Date 12-12-2018
     */
    public function displaydata(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $report_date = $input['report_date'];
        $status_type = $input['status_type'];
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];
        $select_format = $input['select_format'];
        $name =$this->findNameById('depots','name',$depot_id);
    
        $title = 'Audit Status Report'; // Report title

        $meta = [ // For displaying filters description on header
            'Date' => $report_date ,
            'Status Type' => $status_type,
            'Shift' => $status_type,
            'Title' => $title
        ];   
    
        $data = Waybill::with(['etm:id,etm_no', 'route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'conductor:id,crew_name,crew_id', 'vehicle:id,vehicle_registration_number', 'etmLoginDetails:abstract_no,login_timestamp,logout_timestamp']);
        if($depot_id)
        {
            $data = $data->where('depot_id', $depot_id);
        }

        if($report_date)
        {
            $data = $data->whereDate('date', $report_date);
        }

        if($status_type)
        {
            $data = $data->where('status', $status_type);
        }

        if($etm_no)
        {
            $data = $data->where('etm_no', $etm_no);
        }

        if($shift_id)
        {
            $data = $data->where('shift_id', $shift_id);
        }
        
                
        $data = $data->orderBy('waybills.id')
                ->paginate(15);
                //->limit(5)
                //->get(['status', 'abstract_no', 'etm_no', 'route_id', 'duty_id', 'shift_id', 'conductor_id', 'vehicle_id']);

        //return response()->json($data);

        return view('reports.etm.audit_status.index', compact('data', 'meta'));
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
        $report_date = $input['report_date'] ? date('Y-m-d', strtotime($input['report_date'])) : '';
        $status_type = $input['status_type'];
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];
        $select_format = $input['select_format'];
        $name =$this->findNameById('depots','name',$depot_id);
    
        $title = 'ETM Audit Status Report'; // Report title

        if($depot_id)
        {
            $depot = Depot::whereId($depot_id)->first();
            if($depot)
            {
                $depotName = $depot->name;
            }else{
                $depotName = '';
            }
        }else{
            $depotName = '';
        }

        if($status_type == 's')
        {
            $status = 'Submitted';
        }elseif($status_type == 'c')
        {
            $status = 'Completed';
        }else{
            $status = 'Generated';
        }

        if($shift_id)
        {
            $shift = Shift::whereId($shift_id)->first();
            if($shift)
            {
                $shiftName = $shift->shift;
            }else{
                $shiftName = "";
            }
        }else{
            $shiftName = "";
        }

        if($etm_no)
        {
            $etm = ETMDetail::whereId($etm_no)->first();
            if($etm)
            {
                $etmNumber = $etm->etm_no;
            }else{
                $etmNumber = '';
            }
        }else{
            $etmNumber = '';
        }

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Date : ' . $report_date,
            'Shift : ' . $shiftName,
            'Status Type : ' . $status,
            'ETM No. : ' . $etmNumber
        ];   
    
        $data = Waybill::with(['etm:id,etm_no', 'route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'conductor:id,crew_name,crew_id', 'vehicle:id,vehicle_registration_number', 'etmLoginDetails:abstract_no,login_timestamp,logout_timestamp']);

        if($depot_id)
        {
            $data = $data->where('depot_id', $depot_id);
        }

        if($report_date)
        {
            $data = $data->whereDate('date', $report_date);
        }

        if($status_type)
        {
            $data = $data->where('status', $status_type);
        }

        if($etm_no)
        {
            $data = $data->where('etm_no', $etm_no);
        }

        if($shift_id)
        {
            $data = $data->where('shift_id', $shift_id);
        }
        
                
        $data = $data->orderBy('waybills.id')
                //->limit(5)
                ->get(['status', 'abstract_no', 'etm_no', 'route_id', 'duty_id', 'shift_id', 'conductor_id', 'vehicle_id']);

        //data should be like below data
        /*
        [
            ['col1', 'col2', '...'],
            ['val1', 'val2', '...'],
            ['val1', 'val2', '...'],
            ...
        ]
        */
        $reportData = [
                        ['S. No.', 'ETM No.', 'Login Time', 'Route-Duty-Shift', 'Logout Time', 'Conductor', 'Vehicle No.', 'Handed Over To', 'Audited']
                    ];
        foreach ($data as $key => $value) 
        {
            if($value->status == 'c')
            {
                $audited = "Yes";
            }else{
                $audited = "No";
            }
            $row = [(string)($key+1), (string)$value->etm->etm_no, (string)($value->etmLoginDetails->login_timestamp), (string)($value->route->route_name." / ".$value->duty->duty_number." / ".$value->shift->shift), (string)($value->etmLoginDetails->logout_timestamp), (string)($value->conductor->crew_name), (string)($value->vehicle->vehicle_registration_number), '', (string)($audited)];

            //return $row;

            array_push($reportData, $row);
        }

        //return $reportData;

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        //return $input;
        $depot_id = $input['depot_id'];
        $report_date = $input['report_date'] ? date('Y-m-d', strtotime($input['report_date'])) : '';
        $status_type = $input['status_type'];
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];
        $select_format = $input['select_format'];
        $name =$this->findNameById('depots','name',$depot_id);
    
        $title = 'ETM Audit Status Report'; // Report title

        if($depot_id)
        {
            $depot = Depot::whereId($depot_id)->first();
            if($depot)
            {
                $depotName = $depot->name;
            }else{
                $depotName = '';
            }
        }else{
            $depotName = '';
        }

        if($status_type == 's')
        {
            $status = 'Submitted';
        }elseif($status_type == 'c')
        {
            $status = 'Completed';
        }else{
            $status = 'Generated';
        }

        if($shift_id)
        {
            $shift = Shift::whereId($shift_id)->first();
            if($shift)
            {
                $shiftName = $shift->shift;
            }else{
                $shiftName = "";
            }
        }else{
            $shiftName = "";
        }

        if($etm_no)
        {
            $etm = ETMDetail::whereId($etm_no)->first();
            if($etm)
            {
                $etmNumber = $etm->etm_no;
            }else{
                $etmNumber = '';
            }
        }else{
            $etmNumber = '';
        }

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Date : ' => $report_date,
            'Shift : ' => $shiftName,
            'Status Type : ' => $status,
            'ETM No. : ' => $etmNumber
        ];   

        $columns = [
                        'ETM No.'=> function($row){
                            return $row->etm->etm_no;
                        }, 
                        'Login Time' => function($row){
                            return $row->etmLoginDetails->login_timestamp;
                        }, 'Route - Duty - Shift' => function($row){
                            return $row->route->route_name.' - '.$row->duty->duty_number.' - '.$row->shift->shift;
                        }, 'Logout Time' => function($row){
                            return $row->etmLoginDetails->logout_timestamp;
                        }, 'Conductor' => function($row){
                            return $row->conductor->crew_name.' ('.$row->conductor->crew_id.')';
                        }, 'Vehicle No.' => function($row){
                            return $row->vehicle->vehicle_registration_number;
                        }, 'Handed Over To' => function($row){
                            return '';
                        }, 'Audited' => function($row){
                            return $row->status == 'c' ? 'Yes' : 'No';
                        }];
    
        $data = Waybill::with(['etm:id,etm_no', 'route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'conductor:id,crew_name,crew_id', 'vehicle:id,vehicle_registration_number', 'etmLoginDetails:abstract_no,login_timestamp,logout_timestamp']);

        if($depot_id)
        {
            $data = $data->where('depot_id', $depot_id);
        }

        if($report_date)
        {
            $data = $data->whereDate('date', $report_date);
        }

        if($status_type)
        {
            $data = $data->where('status', $status_type);
        }

        if($etm_no)
        {
            $data = $data->where('etm_no', $etm_no);
        }

        if($shift_id)
        {
            $data = $data->where('shift_id', $shift_id);
        }
        
                
        $data = $data->orderBy('waybills.id');
                //->limit(5)
                //->get(['status', 'abstract_no', 'etm_no', 'route_id', 'duty_id', 'shift_id', 'conductor_id', 'vehicle_id']);

        $title = 'Registered User Report'; // Report title

        return ExcelReport::of($title, $meta, $data, $columns)
                    ->download($title.'.xlsx');
    }   
}
