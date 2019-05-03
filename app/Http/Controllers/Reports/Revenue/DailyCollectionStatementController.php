<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use App\Models\Crew;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\Inspection;
use App\Models\ETMLoginLog;
use App\Traits\activityLog;
use App\Models\Denomination;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class DailyCollectionStatementController extends Controller
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
        return view('reports.revenue.daily_collection_statement.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $date = date('Y-m-d', strtotime($input['date']));
        $shift_id = $input['shift_id'];
       	
       	$queryBuilder = $this->getQueryBuilder($depot_id, $date, $shift_id);	
       	//return $queryBuilder->toSql();
       	$data = $queryBuilder->paginate(10);
       	return view('reports.revenue.daily_collection_statement.index', compact('data'));
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
        $shift_id = $input['shift_id'];
       	
       	$queryBuilder = $this->getQueryBuilder($depot_id, $date, $shift_id);	
  
        $depotName = $this->findNameById('depots', 'name', $depot_id); 
        $shiftName = $this->findNameById('shifts', 'shift', $shift_id);

        $shiftName = $shiftName ? $shiftName : 'All';   
    
        $title = 'Daily Collection Statement Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Date : '.date('d-m-Y', strtotime($date)),
            'Shift : '.$shiftName
        ];   

        $reportData = $queryBuilder->get();

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name, 'depotName'=>$depotName], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $date = date('Y-m-d', strtotime($input['date']));
        $shift_id = $input['shift_id'];
       	
       	$queryBuilder = $this->getQueryBuilder($depot_id, $date, $shift_id);	
  
        $depotName = $this->findNameById('depots', 'name', $depot_id); 
        $shiftName = $this->findNameById('shifts', 'shift', $shift_id);

        $shiftName = $shiftName ? $shiftName : 'All';
    
        $title = 'Daily Collection Statement Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Date : '=> date('d-m-Y', strtotime($date)),
            'Shift : '=>$shiftName
        ]; 

        $data = $getQueryBuilder->get();
      
        $reportColumns = ['S. No', 'Route/Duty/Shift', 'Abstract No.', 'Crew ID', 'No. of Trips', 'Kms', 'PPT Ticket Count', 'PPT Ticket Amount (Rs)', 'PPT Pass Sold Count', 'PPT Pass Sold Amount (Rs)', 'ETM Passenger Count', 'ETM Ticket Count',  'ETM Ticket Amount (Rs)', 'ETM Pass Sold Count', 'ETM Pass Sold Amount (Rs)', 'ETM E-Purse Count', 'ETM E-Purse Amount (Rs)', 'Payout Amount (Rs)', 'Lugg Amount (Rs)', 'Toll Amount (Rs)', 'Batta/Tea Allowance (Rs)', 'Incentives (Rs)', 'Amount Payable/Adjustment Amount (Rs)', 'Amount Remitted/After Adjustment Amount (Rs)'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            $route = $d->route->route_name.'/'.$d->duty->duty_number.'/'.$d->shift->shift;
            $abstract_no = $d->abstract_no;
            $conductor = $d->conductor->crew_id;
            $trips = $d->trips->count();
            $distance = $d->trips->pluck('route.distance')->sum();
            $ppt_count = $d->ppt_count?$d->ppt_count:0;
            $ppt_amount = number_format((float)$d->ppt_amount, 2, '.', '');
            $ppp_count = $d->ppp_count?$d->ppp_count:0;
            $ppp_amount = number_format((float)$d->ppp_amount, 2, '.', '');
            $passenger_count = $d->passenger_count;
            $tickets_count = $d->tickets_count;
            $tickets_amount = number_format((float)$d->tickets_amount, 2, '.', '');
            $pass_count = $d->pass_count;
            $pass_amount = number_format((float)$d->pass_amount, 2, '.', '');
            $epurse_count = $d->epurse_count;
            $epurse_amount = number_format((float)$d->epurse_amount, 2, '.', '');
            $payouts = $d->payouts->pluck('amount')->sum();
            $baggage_amount = number_format((float)$d->baggage_amount, 2, '.', '');
            $toll_amount = number_format((float)$d->toll_amount, 2, '.', '');
            $incentives = number_format((float)$d->incentives, 2, '.', '');
            $batta_tea_allowance = number_format((float)$d->batta_tea_allowance, 2, '.', '');
            $amount_payable = number_format((float)$d->cashCollection->amount_payable, 2, '.', '');
            $cash_remitted = number_format((float)$d->cashCollection->cash_remitted, 2, '.', '');

            array_push($reportData, [(string)($key+1), (string)$route, (string)$abstract_no, (string)$conductor, (string)$trips, (string)$distance, (string)$ppt_count, (string)$ppt_amount, (string)$ppp_count, (string)$ppp_amount, (string)$passenger_count, (string)$tickets_count, (string)$tickets_amount, (string)$pass_count, (string)$pass_amount, (string)$epurse_count, (string)$epurse_amount, (string)$payouts, (string)$baggage_amount, (string)$toll_amount, (string)$incentives, (string)$batta_tea_allowance, (string)$amount_payable, (string)$cash_remitted]);
        }

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);     
    }

    public function getQueryBuilder($depot_id, $date, $shift_id)
    {
        $queryBuilder = Waybill::with(['route:id,route_name', 'duty:id,duty_number', 'auditRemittance:waybill_number,created_date', 'cashCollection', 'tickets.concession', 'trips.route', 'auditInventory', 'payouts:abstract_no,amount', 'shift:id,shift', 'conductor:id,crew_id'])
	        ->withCount(['tickets as tickets_count'=>function($query){
	        	$query->where('ticket_type', 'Ticket');
	        }])->withCount(['tickets as pass_count'=>function($query){
	        	$query->where('ticket_type', 'Pass')
	        		  ->orWhere('ticket_type', 'ETMPass');
	        }])->withCount(['tickets as epurse_count'=>function($query){
	        	$query->where('ticket_type', 'EPurse');
	        }])->withCount(['tickets as tickets_amount'=>function($query){
	        	$query->where('ticket_type', 'Ticket')
	        		  ->select(DB::raw("SUM(total_amt)"));
	        }])->withCount(['tickets as pass_amount'=>function($query){
	        	$query->where('ticket_type', 'Pass')
	        		  ->orWhere('ticket_type', 'ETMPass')
	        		  ->select(DB::raw("SUM(total_amt)"));
	        }])->withCount(['tickets as epurse_amount'=>function($query){
	        	$query->where('ticket_type', 'EPurse')
	        		  ->select(DB::raw("SUM(total_amt)"));
	        }])->withCount(['tickets as passenger_count'=>function($query){
	        	$query->select(DB::raw("(SUM(adults) + SUM(childs))"));
	        }])->withCount(['tickets as baggage_amount'=>function($query){
	        	$query->select(DB::raw("SUM(baggage_amt)"));
	        }])->withCount(['tickets as toll_amount'=>function($query){
	        	$query->select(DB::raw("SUM(toll_amt)"));
	        }])->withCount(['auditRemittance as incentives'=>function($query){
	        	$query->select(DB::raw("(SUM(conductor_incentive)+SUM(driver_incentive))"));
	        }])->withCount(['auditRemittance as batta_tea_allowance'=>function($query){
	        	$query->select(DB::raw("(SUM(batta)+SUM(tea_allowance))"));
	        }])->withCount(['auditInventory as ppt_count'=>function($query){
	        	$query->whereHas('denomination', function($q){
	        		$q->whereHas('denominationMaster', function($p){
	        			$p->where('id', 1);
	        		});
	        	})->select(DB::raw("SUM(quantity)"));
	        }])->withCount(['auditInventory as ppt_amount'=>function($query){
	        	$query->whereHas('denomination', function($q){
	        		$q->whereHas('denominationMaster', function($p){
	        			$p->where('id', 1);
	        		});
	        	})->select(DB::raw("SUM(sold_ticket_value)"));
	        }])->withCount(['auditInventory as ppp_count'=>function($query){
	        	$query->whereHas('denomination', function($q){
	        		$q->whereHas('denominationMaster', function($p){
	        			$p->where('id', 2);
	        		});
	        	})->select(DB::raw("SUM(quantity)"));
	        }])->withCount(['auditInventory as ppp_amount'=>function($query){
	        	$query->whereHas('denomination', function($q){
	        		$q->whereHas('denominationMaster', function($p){
	        			$p->where('id', 2);
	        		});
	        	})->select(DB::raw("SUM(sold_ticket_value)"));
	        }]);	

        if($depot_id)
        {
            $queryBuilder = $queryBuilder->where('depot_id', $depot_id);
        }

        if($date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', $date);
        }

        if($shift_id)
        {
        	$queryBuilder = $queryBuilder->whereDate('shift_id', $shift_id);
        }

        return $queryBuilder;
    }
}
