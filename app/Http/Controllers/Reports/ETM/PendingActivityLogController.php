<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use Validator;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\ETMLoginLog;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class PendingActivityLogController extends Controller
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

        $data = $getQueryBuilder->paginate(10);

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
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $pending_activity = $input['pending_activity'];

        $getQueryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $pending_activity);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'ETM Pending Activity Log Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $pending_activity_text = $pending_activity ? ucfirst($pending_activity_text) : 'All';
        $meta = [ // For displaying filters description on header
            'Depot : ' . ucfirst($depotName),
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Pending Activity : '.$pending_activity_text
        ];   

        $reportData = $getQueryBuilder->get();   

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $pending_activity = $input['pending_activity'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $pending_activity);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'ETM Pending Activity Log Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $pending_activity_text = $pending_activity ? ucfirst($pending_activity_text) : 'All';

        $meta = [ // For displaying filters description on header
            'Depot : ' . ucfirst($depotName),
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'Pending Activity : ' . $pending_activity_text
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Date', 'ETM No.', 'Conductor ID', 'Route', 'Duty', 'Shift', 'Login Timestamp', 'Logout Timestamp', 'Audit Timestamp', 'Remittance Timestamp'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            $login_timestamp = $d->etmLoginDetails->login_timestamp ? date('d-m-Y H:i:s', strtotime($d->etmLoginDetails->login_timestamp)) : 'Pending';
            $logout_timestamp = $d->etmLoginDetails->logout_timestamp ? date('d-m-Y H:i:s', strtotime($d->etmLoginDetails->logout_timestamp)) : 'Pending';
            $audit_timestamp = $d->auditRemittance->created_date?date('d-m-Y H:i:s', strtotime($d->auditRemittance->created_date)):'Pending';
            $remittance_timestamp = $d->cashCollection->submitted_at?date('d-m-Y H:i:s', strtotime($d->cashCollection->submitted_at)):'Pending';


            array_push($reportData, [(string)($key+1), (string)date('d-m-Y', strtotime($d->date)), (string)$d->etm->etm_no, (string)$d->conductor->crew_id, (string)$d->route->route_name, (string)$d->duty->duty_number, (string)$d->shift->shift, (string)$login_timestamp, (string)$logout_timestamp, (string)$audit_timestamp, (string)$remittance_timestamp]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);       
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $pending_activity)
    {
        $getQueryBuilder = Waybill::with(['etmLoginDetails:abstract_no,login_timestamp,logout_timestamp', 'etm:id,etm_no', 'route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'conductor:id,crew_name,crew_id', 'auditRemittance:waybill_number,created_date', 'cashCollection:abstract_no,submitted_at']);

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
