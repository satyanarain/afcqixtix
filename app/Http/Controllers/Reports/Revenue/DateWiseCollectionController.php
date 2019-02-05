<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Crew;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\Inspection;
use App\Models\ETMLoginLog;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Models\Denomination;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class DateWiseCollectionController extends Controller
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
    
        $title = 'Daily Collection Statement Report'; // Report title

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

      
        $columns = [
                        'Route/Duty/Shift'=> function($row){
                            return $row->route->route_name.'/'.$row->duty->duty_number.'/'.$row->shift->shift;
                        },
                        'Abstract No.'=> function($row){
                            return $row->abstract_no;
                        }, 
                        'Crew ID' => function($row){
                            return $row->conductor->crew_id;
                        },
                        'No. of Trips'=> function($row){
                            return $row->trips->count();
                        },
                        'Kms' => function($row){
                            return $row->trips->pluck('route')->sum('distance');;
                        }, 
                        'Tkt Cnt' => function($row){
                            return $row->tickets_count?$row->tickets_count:0;
                        }, 
                        'Tkt Amt (Rs)' => function($row){
                            return $row->tickets_amount?$row->tickets_amount:0;
                        }, 
                        'Pass Sold Cnt' => function($row){
                            return $row->pass_count?$row->pass_count:0;
                        }, 
                        'Pass Sold Amt (Rs)' => function($row){
                            return $row->pass_amount?$row->pass_amount:0;
                        }, 
                        'Passenger Cnt' => function($row){
                            return $row->passenger_count;
                        }, 
                        'Tkt Cnt' => function($row){
                            return $row->ppt_count;
                        }, 
                        'Tkt Amt (Rs)' => function($row){
                            return $row->ppt_amount;
                        }, 
                        'Pass Sold Cnt' => function($row){
                            return $row->ppp_count;
                        }, 
                        'Pass Sold Amt (Rs)' => function($row){
                            return $row->ppp_amount;
                        }, 
                        'EPurse Cnt' => function($row){
                            return $row->epurse_count;
                        }, 
                        'EPurse Amt (Rs)' => function($row){
                            return $row->epurse_amount?$row->epurse_amount:0;
                        }, 
                        'Payout Amt (Rs)' => function($row){
                            return $row->payouts->pluck('amount')->sum();
                        }, 
                        'Lugg Amt (Rs)' => function($row){
                            return $row->baggage_amount;
                        }, 
                        'Toll Amt (Rs)' => function($row){
                            return $row->toll_amount;
                        }, 
                        'Batta/Tea Allowance (Rs)' => function($row){
                            return $row->batta_tea_allowance;
                        }, 
                        'Incentives (Rs)' => function($row){
                            return $row->incentives;
                        }, 
                        'Amt Payable/Adjustment Amt (Rs)' => function($row){
                            return $row->cashCollection->amount_payable;
                        }, 
                        'Amt Remitted/After Adjustment Amt (Rs)' => function($row){
                            return $row->cashCollection->cash_remitted;
                        }];

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
        					->editColumns(['No. of Trips', 'Kms', 'Tkt Cnt', 'Tkt Amt (Rs)', 'Pass Sold Cnt', 'Pass Sold Amt (Rs)', 'Passenger Cnt', 'Tkt Cnt', 'Tkt Amt (Rs)', 'Pass Sold Cnt', 'Pass Sold Amt (Rs)', 'EPurse Cnt', 'EPurse Amt (Rs)', 'Payout Amt (Rs)', 'Lugg Amt (Rs)', 'Toll Amt (Rs)', 'Batta/Tea Allowance (Rs)', 'Incentives (Rs)', 'Amt Payable/Adjustment Amt (Rs)', 'Amt Remitted/After Adjustment Amt (Rs)'], ['class' => 'right'])
        					->download($title.'.xlsx');        
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
