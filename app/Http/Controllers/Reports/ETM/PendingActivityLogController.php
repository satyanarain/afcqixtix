<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\ETMLoginLog;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class PendingActivityLogController extends Controller
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
        return view('reports.etm.pending_activity_log.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $pending_activity = $input['pending_activity'];

        $getQueryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $pending_activity);

        return $data = $getQueryBuilder->paginate(10);

        $flag = 1;
       			
       	return view('reports.etm.pending_activity_log.index', compact('data', 'flag'));
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
        $date = date('Y-m-d', strtotime($input['date']));
        $etm_no = $input['etm_no'];

        $data = Waybill::with(['route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'depotHead:id,name', 'conductor:id,crew_name', 'vehicle:id,vehicle_registration_number', 'etm:id,etm_no']);

        if($etm_no)
        {
        	$data = $data->where('etm_no', $etm_no);
        }

        if($shift_id)
        {
        	$data = $data->where('shift_id', $shift_id);
        }

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->orderBy('id', 'ASC');

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $etmNo = $this->findNameById('etm_details', 'etm_no', $etm_no);
        $shift = $this->findNameById('shifts', 'shift', $shift_id);

        $shift = $shift ? $shift : 'All';
    
        $title = 'ETM Pending Activity Log Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date)),
            'ETM No. : '.$etmNo,
            'Shift : '.$shift
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
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];

        $data = Waybill::with(['route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'depotHead:id,name', 'conductor:id,crew_name', 'vehicle:id,vehicle_registration_number', 'etm:id,etm_no']);

        if($etm_no)
        {
        	$data = $data->where('etm_no', $etm_no);
        }

        if($shift_id)
        {
        	$data = $data->where('shift_id', $shift_id);
        }

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->orderBy('id', 'ASC');

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $etmNo = $this->findNameById('etm_details', 'etm_no', $etm_no);
        $shift = $this->findNameById('shifts', 'shift', $shift_id);

        $shift = $shift ? $shift : 'All';
    
        $title = 'ETM Pending Activity Log Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date)),
            'ETM No. : '=>$etmNo,
            'Shift : '=>$shift
        ]; 

      
        $columns = [
                        'Abstract'=> function($row){
                            return $row->abstract_no;
                        },
                        'Waybill'=> function($row){
                            return $row->waybill_no;
                        },
                        'Route'=> function($row){
                            return $row->route->route_name;
                        },
                        'Duty' => function($row){
                            return $row->duty->duty_number;
                        }, 
                        'Shift' => function($row){
                            return $row->shift->shift;
                        }, 
                        'Conductor' => function($row){
                            return $row->conductor->crew_name;
                        }, 
                        'Vehicle' => function($row){
                            return $row->vehicle->vehicle_registration_number;
                        }, 
                        'ETM No.' => function($row){
                            return $row->etm->etm_no;
                        }, 
                        'Issued By' => function($row){
                            return $row->depotHead->name;
                        }, 
                        'Received By' => function($row){
                            return $row->conductor->crew_name;
                        }, 
                        'Issuance Timestamp' => function($row){
                            return date('d-m-Y H:i:s', strtotime($row->etm_issue_time));
                        }];

        return ExcelReport::of($title, $meta, $data, $columns)
        					->download($title.'.xlsx');        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $pending_activity)
    {
        $getQueryBuilder = Waybill::with(['etmLoginDetails:abstract_no,login_timestamp,logout_timestamp', 'etm:id,etm_no', 'route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'conductor:id,crew_name,crew_id', 'auditRemittance:waybill_number:created_date', 'cashCollection:abstract_no,submitted_at']);

        if($pending_activity == 'audit')
        {
            $getQueryBuilder = $getQueryBuilder->where('status', 's');
        }elseif($pending_activity == 'remittance'){
            $getQueryBuilder = $getQueryBuilder->where('status', 'g');
        }elseif($pending_activity == 'logout'){
            $getQueryBuilder = $getQueryBuilder->with(['etmLoginDetails' => function($query){
                $query->whereNull('logout_timestamp');
            }]);
        }else{
            $getQueryBuilder = $getQueryBuilder;
        }

        if($depot_id)
        {
            $getQueryBuilder = $getQueryBuilder->where('depot_id', $depot_id);
        }

        if($from_date && $to_date)
        {
            $getQueryBuilder = $getQueryBuilder->whereDate('created_at', '>=', $from_date)
                                                ->whereDate('created_at', '<=', $to_date);
        }

        return $getQueryBuilder;
    }
}