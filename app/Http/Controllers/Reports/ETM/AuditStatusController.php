<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Crew;
use App\Models\Depot;
use App\Models\Waybill;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Models\ReturnCrewStock;
use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ETM\AuditStatus\StoreAuditStatusRequest;

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
    public function store(StoreAuditStatusRequest $request)
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
                //->limit(5)
                ->get(['status', 'abstract_no', 'etm_no', 'route_id', 'duty_id', 'shift_id', 'conductor_id', 'vehicle_id']);

        //return response()->json($data);

        return view('reports.etm.audit_status.index', compact('data', 'meta'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
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
        $reportData = [['S. No.', 'ETM No.', 'Login Time', 'Route-Duty-Shift', 'Logout Time', 'Conductor', 'Vehicle No.', 'Handed Over To', 'Audited']];
        foreach ($data as $key => $value) 
        {
            $sno = $key +1;
            if($value->status == 'c')
            {
                $audited = "Yes";
            }else{
                $audited = "No";
            }
            $row = [(string)($key+1), (string)$value->etm->etm_no, $value->etmLoginDetails->login_timestamp, $value->route->route_name." / ".$value->duty->duty_number." / ".$value->shift->shift, $value->etmLoginDetails->logout_timestamp, $value->conductor->crew_name, $value->vehicle->vehicle_registration_number, '', $audited];

            //return $row;

            array_push($reportData, $row);
        }

        //return $reportData;

        return response()->json(['status'=>'Ok', 'data'=>$reportData], 200);
    }

   
}
