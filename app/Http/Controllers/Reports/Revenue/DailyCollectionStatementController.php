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

class DailyCollectionStatementController extends Controller
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
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];
        $depotName = $this->findNameById('depots', 'name', $depot_id); 

        $conductorId = $conductor_id ? $conductor_id : 'All';   
    
        $title = 'Daily Collection Statement Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Conductor ID : '.$conductorId
        ];   

        $reportData = $this->getCalculatedData($depot_id, $from_date, $to_date, $conductor_id);

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name, 'depotName'=>$depotName], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];

        $data = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);

        $conductorId = $conductor_id ? $conductor_id : 'All';
    
        $title = 'Daily Collection Statement Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date)),
            'Conductor ID : '=>$conductorId
        ]; 

      
        $columns = [
                        'Depot'=> function($row){
                            return $depotName;
                        },
                        'No. of Duties'=> function($row){
                            return $row->count();
                        }, 
                        'No. of Trips' => function($row){
                            return $row->trips->count();
                        },
                        'Dist. (Kms)'=> function($row){
                            return $row->trips->pluck('route')->sum('distance');
                        },
                        'PPT Tkt Cnt' => function($row){
                            return $row->tickets->count();
                        }, 
                        'Shift' => function($row){
                            return $row->shift->shift;
                        }, 
                        'Login Timestamp' => function($row){
                            return $row->etmLoginDetails->login_timestamp ? date('d-m-Y H:i:s', strtotime($row->etmLoginDetails->login_timestamp)) : 'Pending';
                        }, 
                        'Logout Timestamp' => function($row){
                            return $row->etmLoginDetails->logout_timestamp ? date('d-m-Y H:i:s', strtotime($row->etmLoginDetails->logout_timestamp)) : 'Pending';
                        }, 
                        'Audit Timestamp' => function($row){
                            return $row->auditRemittance->created_date?date('d-m-Y H:i:s', strtotime($row->auditRemittance->created_date)):'Pending';
                        }, 
                        'Remittance Timestamp' => function($row){
                            return $row->cashCollection->submitted_at?date('d-m-Y H:i:s', strtotime($row->cashCollection->submitted_at)):'Pending';
                        }];

        return ExcelReport::of($title, $meta, $data, $columns)
        					->download($title.'.xlsx');        
    }

    public function getQueryBuilder($depot_id, $date, $shift_id)
    {
        $queryBuilder = Waybill::with(['route:id,route_name', 'duty:id,duty_number', 'auditRemittance:waybill_number,created_date', 'cashCollection', 'tickets.concession', 'trips.route', 'auditInventory', 'payouts:abstract_no,amount'])
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
