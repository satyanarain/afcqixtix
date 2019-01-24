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

class ConductorWiseEarningController extends Controller
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
        return view('reports.revenue.conductor_wise_earning.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id);

        $data = $queryBuilder->paginate(10);

        return view('reports.revenue.conductor_wise_earning.index', compact('data'));
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
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id);
        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Conductor-wise Earning Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Conductor ID. : '.$conductor_id
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
        $conductor_id = $input['conductor_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $title = 'Conductor-wise Earning Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Conductor ID. : ' => $conductor_id,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 
      
        $columns = [
                        'Conductor Name (ID)'=> function($row){
                            return $row->conductor->crew_name.' ('.$row->conductor->crew_id.')';
                        },
                        'Revenue (Rs)'=> function($row){
                            return number_format((float)$row->auditRemittance->payable_amount, 2, '.', '');
                        },
                        'No. of Trips'=> function($row){
                            return $row->trips ? $row->trips->count() :'0';
                        },
                        'No. of Shifts' => function($row){
                            return $row->shifts ? $row->shifts->count() :'0';
                        }, 
                        'Average Cash Collection (Rs)' => function($row){
                        	if($row->shifts && $row->shifts->count() > 0)
                            {
                                $avg = $row->auditRemittance->payable_amount / $row->shifts->count();
                            }else{
                                $avg = 0;
                            }
                            return number_format((float)$avg, 2, '.', '');
                        }];

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
        					->download($title.'.xlsx');        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id)
    {
        $queryBuilder = Waybill::whereHas('conductor', function($query) use($conductor_id){
        	if($conductor_id)
	        {
	            $query->where('crew_id', $conductor_id);
	        }
        })->with(['trips', 'shifts', 'conductor', 'auditRemittance']);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }
                
        $queryBuilder = $queryBuilder->orderBy('created_at', 'DESC');

        return $queryBuilder;
    }
}
