<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use App\Models\Waybill;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class DateWiseCollectionController extends Controller
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
        return view('reports.revenue.date_wise_collection.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
       	
       	$queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date);	
       	//return $queryBuilder->toSql();
       	$data = $queryBuilder->paginate(5);
       	return view('reports.revenue.date_wise_collection.index', compact('data'));
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
       	
       	$queryBuilder = $this->getQueryBuilder($depot_id, $date, $shift_id);	
  
        $depotName = $this->findNameById('depots', 'name', $depot_id); 
        $shiftName = $this->findNameById('shifts', 'shift', $shift_id);

        $shiftName = $shiftName ? $shiftName : 'All';   
    
        $title = 'Date-wise Collection Statement Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From Date : '.date('d-m-Y', strtotime($from_date)),
            'To Date : '.date('d-m-Y', strtotime($to_date))
        ];   

        $reportData = $queryBuilder->get();

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name, 'depotName'=>$depotName], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $shift_id = $input['shift_id'];
       	
       	$queryBuilder = $this->getQueryBuilder($depot_id, $date, $shift_id);	
  
        $depotName = $this->findNameById('depots', 'name', $depot_id); 
        $shiftName = $this->findNameById('shifts', 'shift', $shift_id);

        $shiftName = $shiftName ? $shiftName : 'All';
    
        $title = 'Date-wise Collection Statement Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . ucfirst($depotName),
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Route/Duty/Shift', 'Abstract No.', 'Crew ID', 'No. of Trips', 'Kms', 'PPT Ticket Count', 'PPT Ticket Amount (Rs)', 'PPT Pass Sold Count', 'PPT Pass Sold Amount (Rs)', 'ETM Passenger Count', 'ETM Ticket Count', 'ETM Ticket Amount (Rs)', 'ETM Pass Sold Count', 'ETM Pass Sold Amount (Rs)', 'ETM EPurse Count', 'ETM EPurse Amount (Rs)', 'Payout Amount (Rs)', 'Lugg Amount (Rs)', 'Toll Amount (Rs)', 'Batta/Tea Allowance (Rs)', 'Incentives (Rs)', 'Amount Payable/Adjustment Amount (Rs)', 'Amount Remitted/After Adjustment Amount (Rs)'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            $passenger_count = $d->passenger_count ? $d->passenger_count : '0';
            $ppt_count = $d->ppt_count ? $d->ppt_count : '0';
            $ppt_amount = $d->ppt_amount ? $d->ppt_amount : '0';
            $ppp_count = $d->ppp_count ? $d->ppp_count : '0';
            $ppp_amount = $d->ppp_amount ? $d->ppp_amount : '0';
            $epurse_count = $d->epurse_count ? $d->epurse_count : '0';
            $epurse_amount = $d->epurse_amount ? $d->epurse_amount : '0';
            $payouts = $d->payouts->pluck('amount')->sum() ? $d->payouts->pluck('amount')->sum() : '0';
            $baggage_amount = $d->baggage_amount ? $d->baggage_amount : '0';
            $toll_amount = $d->toll_amount ? $d->toll_amount : '0';
            $batta_tea_allowance = $d->batta_tea_allowance ? $d->batta_tea_allowance : '0';
            $incentives = $d->incentives ? $d->incentives : '0';
            $amount_payable = $d->cashCollection->amount_payable ? $d->cashCollection->amount_payable : '0';
            $cash_remitted = $d->cashCollection->cash_remitted ? $d->cashCollection->cash_remitted : '0';

            array_push($reportData, [(string)($key+1), $d->route->route_name.'/'.$d->duty->duty_number.'/'.$d->shift->shift, (string)$d->abstract_no, (string)$d->conductor->crew_id, (string)$d->trips->count(), (string)$d->trips->pluck('route')->sum('distance'), (string)$d->tickets_count?$d->tickets_count:'0', (string)$d->tickets_amount?$d->tickets_amount:'0', (string)$d->pass_count?$d->pass_count:'0', (string)$d->pass_amount?$d->pass_amount:'0', (string)$passenger_count, (string)$ppt_count, (string)$ppt_amount, (string)$ppp_count, (string)$ppp_amount, (string)$epurse_count, (string)$epurse_amount, (string)$payouts, (string)$baggage_amount, (string)$toll_amount, (string)$batta_tea_allowance, (string)$incentives, (string)$amount_payable, (string)$cash_remitted]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);       
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date)
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

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
            							 ->whereDate('created_at', '<=', $to_date);
        }

        if($shift_id)
        {
        	$queryBuilder = $queryBuilder->whereDate('shift_id', $shift_id);
        }

        return $queryBuilder->orderBy('created_at', 'DESC');
    }
}
