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

class ActivityLogController extends Controller
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
        return view('reports.etm.activity_log.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $etm_no = $input['etm_no'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no);

        $data = $queryBuilder->paginate(10);

        $data->getCollection()->transform(function($value)use($to_date){
            if($value->logout_timestamp)
            {
                $logoutSeconds = strtotime($value->logout_timestamp);
            }else {
                $logoutSeconds = strtotime($value->login_timestamp) + 8*60*60;
            }
            $loginSeconds = strtotime($value->login_timestamp);

            $dutyHours = (int)(($logoutSeconds - $loginSeconds) / 3600);  

            $value->dutyHours = $dutyHours;
            $value->totalTicket = $value->wayBill->tickets->count();

            return $value;
        });

        //return $data;
        
       	return view('reports.etm.activity_log.index', compact('data'));
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
        $etm_no = $input['etm_no'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no);   

        $depotName = $this->findNameById('depots', 'name', $depot_id);

        $title = 'ETM Activity Log Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . ucfirst($depotName),
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'ETM No. : ' . $etm_no
        ];   

        $reportData = $queryBuilder->get();  

        foreach ($reportData as $key => $value) 
        {
            if($value->logout_timestamp)
            {
                $logoutSeconds = strtotime($value->logout_timestamp);
            }else {
                $logoutSeconds = strtotime($value->login_timestamp) + 8*60*60;
            }
            $loginSeconds = strtotime($value->login_timestamp);

            $dutyHours = (int)(($logoutSeconds - $loginSeconds) / 3600);  

            $value->dutyHours = $dutyHours;
            $value->totalTicket = $value->wayBill->tickets->count();
        } 

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $etm_no = $input['etm_no'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no);   

        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'ETM Activity Log Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . ucfirst($depotName),
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'ETM No. : ' . $etm_no
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Conductor Name', 'Route', 'Duty', 'Login On', 'Logout On', 'Duty Hours', 'Tkt + Pass', 'Error Tkt Prntd', 'Battery Percentage On Login', 'Battery Percentage On Logout'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            if($d->logout_timestamp)
            {
                $logoutSeconds = strtotime($d->logout_timestamp);
            }else {
                $logoutSeconds = strtotime($d->login_timestamp) + 8*60*60;
            }
            $loginSeconds = strtotime($d->login_timestamp);

            $dutyHours = (int)(($logoutSeconds - $loginSeconds) / 3600);

            array_push($reportData, [(string)($key+1), (string)$d->conductor->crew_name, (string)$d->wayBill->route->route_name, (string)$d->wayBill->duty->duty_number, (string)$d->login_timestamp ? date('d-m-Y H:i:s', strtotime($d->login_timestamp)) : "", (string)$d->logout_timestamp ? date('d-m-Y H:i:s', strtotime($d->logout_timestamp)) : "", (string)$dutyHours, (string)$d->wayBill->tickets->count(), (string)"", (string)$d->battery_percentage, (string)$d->battery_percentage]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);     
    }


    public function getQueryBuilder($depot_id, $from_date, $to_date, $etm_no)
    {
        $queryBuilder = ETMLoginLog::whereHas('wayBill', function($query) use ($depot_id){
                            $query->where('depot_id', $depot_id);
                        })->whereHas('etm', function($query) use ($etm_no){
                            $query->where('etm_no', $etm_no);
                        })->with(['conductor:id,crew_name,crew_id', 'etm:id,etm_no', 'wayBill.tickets', 'wayBill.route', 'wayBill.duty']);
        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('login_timestamp', '>=', $from_date)
                                         ->whereDate('login_timestamp', '<=', $to_date);
        }

        return $queryBuilder;
    }
}
