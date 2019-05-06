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

class NotSyncController extends Controller
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
        return view('reports.etm.not_sync.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $etm_no = $input['etm_no'];

        $getQueryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no);

        $data = $getQueryBuilder->paginate(10);

        $data->getCollection()->transform(function($value)use($to_date){
        	$login_timestamp_seconds = strtotime($value->login_timestamp);
        	$to_date_seconds = strtotime($to_date);
        	$diff = $to_date_seconds - $login_timestamp_seconds;
        	$value->no_of_days = round($diff/(60*60*24));

        	$latestTicket = Ticket::where('abstract_id', $value->abstract_no)
        							->orderBy('id', 'DESC')
        							->first();
        	if($latestTicket)
        	{
        		$value->last_manual_sync = date('d-m-Y h:i A', strtotime($latestTicket->created_at));
        	}

        	return $value;
        });

        $flag = 1;
       			
       	return view('reports.etm.not_sync.index', compact('data', 'flag'));
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

        $getQueryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no);

        $data = $getQueryBuilder->get();

        foreach($data as $key=>$value)
        {
        	$login_timestamp_seconds = strtotime($value->login_timestamp);
        	$to_date_seconds = strtotime($to_date);
        	$diff = $to_date_seconds - $login_timestamp_seconds;
        	$value->no_of_days = round($diff/(60*60*24));

        	$latestTicket = Ticket::where('abstract_id', $value->abstract_no)
        							->orderBy('id', 'DESC')
        							->first();
        	if($latestTicket)
        	{
        		$value->last_manual_sync = date('d-m-Y h:i A', strtotime($latestTicket->created_at));
        	}

        	$value->login_timestamp = date('d-m-Y h:i A', strtotime($value->login_timestamp));
        	$value->logout_timestamp = date('d-m-Y h:i A', strtotime($value->logout_timestamp));
        }

        //return $data;

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $etmNo = $this->findNameById('etm_details', 'etm_no', $etm_no);
    
        $title = 'ETM Not Sync Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Till Date : '.date('d-m-Y', strtotime($to_date)),
            'ETM No. : '.$etmNo
        ];

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$data, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
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
        $etmNo = $this->findNameById('etm_details', 'etm_no', $etm_no);
    
        $title = 'ETM Not Sync Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Till Date : ' . date('d-m-Y', strtotime($to_date)),
            'ETM No. : ' . $etmNo
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'ETM No.', 'Last Manual Sync On', 'Login Crew Name (Crew ID)', 'Login Timestamp', 'Logout Timestamp', 'No. of Days'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            $latestTicket = Ticket::where('abstract_id', $d->abstract_no)
                                    ->orderBy('id', 'DESC')
                                    ->first();
            if($latestTicket)
            {
                $last_manual_sync = date('d-m-Y h:i A', strtotime($latestTicket->created_at));
            }else{
                $last_manual_sync = '';
            }

            $login_timestamp_seconds = strtotime($d->login_timestamp);
            $to_date_seconds = strtotime($to_date);
            $diff = $to_date_seconds - $login_timestamp_seconds;
            $no_of_days = round($diff/(60*60*24));

            array_push($reportData, [(string)($key+1), (string)$d->etm->etm_no, (string)$last_manual_sync, (string)$d->conductor->crew_name.' ('.$d->conductor->crew_id.')', (string)date('d-m-Y h:i A', strtotime($d->login_timestamp)), (string)date('d-m-Y h:i A', strtotime($d->logout_timestamp)), (string)$no_of_days]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $etm_no)
    {
        $getQueryBuilder = ETMLoginLog::whereHas('wayBill', function($query) use ($depot_id){
                                            if($depot_id)
                                            {
                                                $query->where('depot_id', $depot_id);
                                            }
                                        })
                                        ->whereHas('etm', function($query) use ($etm_no){
                                            if($etm_no)
                                            {
                                                $query->where('etm_no', $etm_no);
                                            }
                                        })
                                        ->with(['conductor:id,crew_name,crew_id', 'etm:id,etm_no']);

        if($from_date && $to_date)
        {
            $getQueryBuilder = $getQueryBuilder->whereDate('login_timestamp', '>=', $from_date)
                                                ->whereDate('login_timestamp', '<=', $to_date);
        }

        return $getQueryBuilder;
    }
}
