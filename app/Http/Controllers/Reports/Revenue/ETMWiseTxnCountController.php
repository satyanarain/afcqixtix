<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Waybill;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class ETMWiseTxnCountController extends Controller
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
            'Depot : ' => $depotName,
            'ETM Number : ' => $etm_no,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 
      
        $columns = [
                        'Date'=> function($row){
                            return date('d-m-Y', strtotime($row->created_at));
                        },
                        'ETM Number'=> function($row){
                            return $row->etm->etm_no;
                        },
                        'Route'=> function($row){
                            return $row->route->route_name;
                        },
                        'Duty' => function($row){
                            return $row->duty->duty_number;
                        }, 
                        'Ticket Count' => function($row){
                            return $row->tickets_count;
                        }, 
                        'Pass Count' => function($row){
                            return $row->pass_count;
                        }, 
                        'EPurse Count' => function($row){
                            return $row->epurse_count;
                        }, 
                        'Passenger (Cash)' => function($row){
                            return $row->cash_passenger_count ? $row->cash_passenger_count : '0';
                        }, 
                        'Passenger (Pass)' => function($row){
                            return $row->card_passenger_count ? $row->card_passenger_count : '0';
                        }, 
                        'Passenger (EPurse)' => function($row){
                            return $row->epurse_passenger_count ? $row->epurse_passenger_count : '0';
                        }, 
                        'Concession' => function($row){
                            return calculateConcession($row->tickets);
                        }];

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
        					->editColumns(['Ticket Count', 'Pass Count', 'EPurse Count', 'Passenger (Cash)', 'Passenger (Pass)', 'Passenger (EPurse)', 'Concession'], [
		                        'class' => 'right',
		                    ])->download($title.'.xlsx');        
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
