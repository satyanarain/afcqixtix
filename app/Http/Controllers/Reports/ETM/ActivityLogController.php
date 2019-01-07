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

class ActivityLogController extends Controller
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
        return view('reports.etm.activity_log.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $date = date('Y-m-d', strtotime($input['date']));
        $etm_no = $input['etm_no'];

        $log = ETMLoginLog::where('etm_id', $etm_no)
        					->whereDate('login_timestamp', $date)
        					->first();
        $flag = 0;

       	if($log)
       	{
       		$abstract_no = $log->abstract_no;
       		if($abstract_no)
       		{
       			$data = Waybill::with(['route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'depotHead:id,name', 'conductor:id,crew_name', 'vehicle:id,vehicle_registration_number', 'etmLoginDetails'])
       					->where('abstract_no', $abstract_no)
       					->first();
       			//return $data;
       			if($data->etmLoginDetails->login_timestamp)
       			{
       				$logoutSeconds = strtotime($data->etmLoginDetails->logout_timestamp);
       			}else {
       				$logoutSeconds = strtotime("now");
       			}
       			$loginSeconds = strtotime($data->etmLoginDetails->login_timestamp);

       			$totalTicket = Ticket::where('abstract_id', $abstract_no)->count();
       			//return;
       			$dutyHours = (int)(($logoutSeconds - $loginSeconds) / 3600);
       			$flag = 1;
       			return view('reports.etm.activity_log.index', compact('data', 'flag', 'dutyHours', 'totalTicket'));
       		}else{
       			$flag = 0;
       			return view('reports.etm.activity_log.index', compact('data', 'flag'));
       		}
       	}else {
       		$flag = 0;
       		return view('reports.etm.activity_log.index', compact('data', 'flag'));
       	}
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

        $data = Waybill::with(['etm:id,etm_no', 'route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'depotHead:id,name', 'conductor:id,crew_name', 'vehicle:id,vehicle_registration_number', 'etmLoginDetails'=>function($query){
            $query->whereDate('login_timestamp', $date);
        }]);
        
        $data = $data->first();
        if($data)
        {
            if($data->etmLoginDetails->login_timestamp)
            {
                $logoutSeconds = strtotime($data->etmLoginDetails->logout_timestamp);
            }else {
                $logoutSeconds = strtotime("now");
            }
            $loginSeconds = strtotime($data->etmLoginDetails->login_timestamp);

            $totalTicket = Ticket::where('abstract_id', $abstract_no)->count();
            //return;
            $dutyHours = (int)(($logoutSeconds - $loginSeconds) / 3600);  

            $data->dutyHours = $dutyHours;
            $data->totalTicket = $totalTicket;
        }            

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $etmNo = $this->findNameById('etm_details', 'etm_no', $etm_no);

        $title = 'ETM Activity Log Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date)),
            'ETM No. : '.$etmNo
        ];   

        $reportData = $data;   

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $date = date('Y-m-d', strtotime($input['date']));
        $etm_no = $input['etm_no'];

        $queryBuilder = Waybill::with(['etm:id,etm_no', 'route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'depotHead:id,name', 'conductor:id,crew_name', 'vehicle:id,vehicle_registration_number', 'etmLoginDetails'=>function($query){
            $query->whereDate('login_timestamp', $date);
        }]);
        
        $data = $queryBuilder->first();
        if($data)
        {
            if($data->etmLoginDetails->login_timestamp)
            {
                $logoutSeconds = strtotime($data->etmLoginDetails->logout_timestamp);
            }else {
                $logoutSeconds = strtotime("now");
            }
            $loginSeconds = strtotime($data->etmLoginDetails->login_timestamp);

            $totalTicket = Ticket::where('abstract_id', $abstract_no)->count();
            //return;
            $dutyHours = (int)(($logoutSeconds - $loginSeconds) / 3600);  

            $data->dutyHours = $dutyHours;
            $data->totalTicket = $totalTicket;
        }

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $etmNo = $this->findNameById('etm_details', 'etm_no', $etm_no);
    
        $title = 'ETM Activity Log Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Date : '=> date('d-m-Y', strtotime($date)),
            'ETM No. : '=>$etmNo
        ]; 

      
        $columns = [
                        'Conductor Name'=> function($row){
                            return $row->conductor->crew_name;
                        },
                        'Route'=> function($row){
                            return $row->route->route_name;
                        },
                        'Duty' => function($row){
                            return $row->duty->duty_number;
                        }, 
                        'Login On' => function($row){
                            return $row->etmLoginDetails->login_timestamp;
                        }, 
                        'Logout On' => function($row){
                            return $row->etmLoginDetails->logout_timestamp;
                        }, 
                        'Duty Hours' => function($row){
                            return $row->dutyHours;
                        }, 
                        'Tkt + Pass' => function($row){
                            return $row->totalTicket;
                        }, 
                        'Error Tkt Prntd' => function($row){
                            return '';
                        }, 
                        'Battery Percentage On Login' => function($row){
                            return $row->etmLoginDetails->battery_percentage;
                        }, 
                        'Battery Percentage On Logout' => function($row){
                            return $row->etmLoginDetails->battery_percentage;
                        }];

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
        					->download($title.'.xlsx');        
    }
}
