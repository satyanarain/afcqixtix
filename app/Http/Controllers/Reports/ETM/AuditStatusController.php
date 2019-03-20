<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use App\Models\Waybill;
use App\Models\ETMDetail;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class AuditStatusController extends Controller
{
    use activityLog;
    use checkPermission;
    use GenerateExcelTrait;

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
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $status_type = $input['status_type'];
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];  
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $shift_id, $status_type, $etm_no);        
                
        $data = $queryBuilder->paginate(10);

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
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $status_type = $input['status_type'];
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];  

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $shiftName = $this->findNameById('shifts', 'shift', $shift_id);
        $etmNumber = $this->findNameById('etm_details', 'etm_no', $etm_no);

        $shiftName = $shiftName ? $shiftName : "";
        $etmNumber = $etmNumber ? $etmNumber : "";
    
        $title = 'ETM Audit Status Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $shiftName = $shiftName ? $shiftName : 'All';
        $etmNumber = $etmNumber ? $etmNumber : 'All';
        if($status_type == 'c')
        {
            $status = 'Audited';
        }else if($status_type == 'u'){
            $status = 'Un-audited ';
        }else {
            $status = 'All';
        }

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'Shift : ' . $shiftName,
            'Status Type : ' . $status,
            'ETM No. : ' . $etmNumber
        ];   
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $shift_id, $status_type, $etm_no);        
                
        $data = $queryBuilder->get();

        //return $data;

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
                $audited = "Audited";
            }else{
                $audited = "Un-audited";
            }
            $row = [(string)($key+1), (string)$value->etm->etm_no, (string)($value->etmLoginDetails->login_timestamp), (string)($value->route->route_name." / ".$value->duty->duty_number." / ".$value->shift->shift), (string)($value->etmLoginDetails->logout_timestamp), (string)($value->conductor->crew_name), (string)($value->vehicle->vehicle_registration_number), '', (string)($audited)];

            array_push($reportData, $row);
        }

        //return $reportData;

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $status_type = $input['status_type'];
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];  

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $shiftName = $this->findNameById('shifts', 'shift', $shift_id);
        $etmNumber = $this->findNameById('etm_details', 'etm_no', $etm_no);
    
        $title = 'ETM Audit Status Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $shiftName = $shiftName ? $shiftName : 'All';
        $etmNumber = $etmNumber ? $etmNumber : 'All';
        if($status_type == 'c')
        {
            $status = 'Audited';
        }else if($status_type == 'u'){
            $status = 'Un-audited ';
        }else {
            $status = 'All';
        }

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'Shift : ' . $shiftName,
            'Status Type : ' . $status,
            'ETM No. : ' . $etmNumber
        ];    
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $shift_id, $status_type, $etm_no);

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'ETM No.', 'Login Time', 'Route-Duty-Shift', 'Logout Time', 'Conductor', 'Vehicle No.', 'Handed Over To', 'Audited'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            $route_duty_shift = $d->route->route_name.'-'.$d->duty->duty_number.'-'.$d->shift->shift;
            $login_timestamp = $d->etmLoginDetails->login_timestamp ? date('d-m-Y H:i:s', strtotime($d->etmLoginDetails->login_timestamp)):"";
            $logout_timestamp = $d->etmLoginDetails->logout_timestamp ? date('d-m-Y H:i:s', strtotime($d->etmLoginDetails->logout_timestamp)):"";
            $conductor = $d->conductor->crew_name.'('.$d->conductor->crew_id.')';
            if($da->status == 'c')
                $status = 'Audited';
            else
                $status = 'Un-audited';

            array_push($reportData, [(string)($key+1), (string)$d->etm->etm_no, (string)$login_timestamp, (string)$route_duty_shift, (string)$logout_timestamp, (string)$conductor, (string)$d->vehicle->vehicle_registration_number, (string)"", (string)$status]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName);
    }   

    public function getQueryBuilder($depot_id, $from_date, $to_date, $shift_id, $status_type, $etm_no)
    {
        $queryBuilder = Waybill::whereHas('etm', function($query) use ($etm_no){
                                        if($etm_no)
                                        {
                                            $query->where('etm_no', $etm_no);
                                        }
                                    })
                                    ->with(['etm:id,etm_no', 'route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'conductor:id,crew_name,crew_id', 'vehicle:id,vehicle_registration_number', 'etmLoginDetails:abstract_no,login_timestamp,logout_timestamp']);

        if($depot_id)
        {
            $queryBuilder = $queryBuilder->where('depot_id', $depot_id);
        }

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('date', '>=', $from_date)
                                         ->whereDate('date', '<=', $to_date);
        }

        if($status_type)
        {
            if($status_type == 'c')
            {
                $queryBuilder = $queryBuilder->where('status', $status_type);
            }else{
                $queryBuilder = $queryBuilder->where('status', '!=', $status_type);
            }            
        }

        if($shift_id)
        {
            $queryBuilder = $queryBuilder->where('shift_id', $shift_id);
        }        
                
        $queryBuilder = $queryBuilder->orderBy('waybills.id');

        return $queryBuilder;
    }

    public function getETMsByDepotId($id)
    {
        $etms = ETMDetail::where('depot_id', $id)->get(['id', 'etm_no']);

        return response()->json($etms, 200);
    }
}
