<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use App\Models\Waybill;
use App\Models\CenterStock;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class ETMWiseTxnCountController extends Controller
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
        return view('reports.revenue.etm_wise_txn_count.index');
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

        return view('reports.revenue.etm_wise_txn_count.index', compact('data'));
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
    
        $title = 'ETM-wise Transaction Count Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'ETM Number : '.$etm_no
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
        $etm_no = $input['etm_no'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $title = 'ETM-wise Transaction Count Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'ETM Number : ' . $etm_no,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Date', 'ETM Number', 'Route', 'Duty', 'Ticket Count', 'Pass Count', 'EPurse Count', 'Passenger (Cash)', 'Passenger (Pass)', 'Passenger (EPurse)', 'Concession'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $rdata) 
        {
            $created_at = date('d-m-Y', strtotime($rdata->created_at));
            $etm = $rdata->etm->etm_no;
            $route = $rdata->route->route_name;
            $duty = $rdata->duty->duty_number;
            $tickets_count = $rdata->tickets_count;
            $pass_count = $rdata->pass_count;
            $epurse_count = $rdata->epurse_count;
            $cash_passenger_count = $rdata->cash_passenger_count?$rdata->cash_passenger_count:'0';
            $card_passenger_count = $rdata->card_passenger_count?$rdata->card_passenger_count:'0';
            $epurse_passenger_count = $rdata->epurse_passenger_count?$rdata->epurse_passenger_count:'0';
            $tickets = calculateConcession($rdata->tickets); 

            array_push($reportData, [(string)($key+1), $created_at, (string)$etm, (string)$route, (string)$duty, (string)$tickets_count, (string)$pass_count, (string)$epurse_count, (string)$cash_passenger_count, (string)$card_passenger_count, (string)$epurse_passenger_count, (string)$tickets]);
        }

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $etm_no)
    {
        $queryBuilder = Waybill::whereHas('etm', function($query) use($etm_no){
        	if($etm_no)
	        {
	            $query->where('etm_no', $etm_no);
	        }
        })->withCount(['tickets as tickets_count'=>function($query){
        	$query->where('ticket_type', 'Ticket');
        }])->withCount(['tickets as pass_count'=>function($query){
        	$query->where('ticket_type', 'Pass')
        		  ->orWhere('ticket_type', 'ETMPass');
        }])->withCount(['tickets as epurse_count'=>function($query){
        	$query->where('ticket_type', 'EPurse');
        }])->withCount(['tickets as cash_passenger_count'=>function($query){
        	$query->select(DB::raw("(SUM(adults) + SUM(childs))"))
        		  ->where('ticket_type', 'Ticket');
        }])->withCount(['tickets as card_passenger_count'=>function($query){
        	$query->select(DB::raw("(SUM(adults) + SUM(childs))"))
        		  ->where('ticket_type', 'Pass')
        		  ->orWhere('ticket_type', 'ETMPass');
        }])->withCount(['tickets as epurse_passenger_count'=>function($query){
        	$query->select(DB::raw("(SUM(adults) + SUM(childs))"))
        		  ->where('ticket_type', 'EPurse');
        }])->with(['etm:id,etm_no', 'tickets:abstract_id,concession_id,adults,childs,total_amt,ticket_type', 'route:id,route_name', 'duty:id,duty_number', 'tickets.concession:id,flat_fare,flat_fare_amount,percentage']);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }
                
        $queryBuilder = $queryBuilder->orderBy('created_at', 'DESC');

        return $queryBuilder;
    }
}
