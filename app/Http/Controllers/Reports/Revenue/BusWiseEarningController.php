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

class BusWiseEarningController extends Controller
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
        return view('reports.revenue.bus_wise_earning.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $bus_no = $input['bus_no'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $bus_no);

        $data = $queryBuilder->paginate(10);

        return view('reports.revenue.bus_wise_earning.index', compact('data'));
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
        $bus_no = $input['bus_no'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $bus_no);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Bus-wise Earning Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Bus No. : '.$bus_no
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
        $bus_no = $input['bus_no'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $bus_no);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $title = 'Bus-wise Earning Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Bus No. : ' => $bus_no,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 
      
        $columns = [
                        'Date'=> function($row){
                            return date('d-m-Y', strtotime($row->created_at));
                        },
                        'Bus No.'=> function($row){
                            return $row->vehicle->vehicle_registration_number;
                        },
                        'No. of Shifts'=> function($row){
                            return number_format((float)$row->shifts->count(), 2, '.', '');
                        },
                        'No. of Trips' => function($row){
                            return number_format((float)$row->trips->count(), 2, '.', '');
                        }, 
                        'Total Km.' => function($row){
                            return number_format((float)$row->trips->pluck('route')->sum('distance'), 2, '.', '');
                        }, 
                        'Total Amt. (Rs)' => function($row){
                            return number_format((float)$row->auditRemittance->payable_amount, 2, '.', '');
                        }];

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
        					->download($title.'.xlsx');        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $bus_no)
    {
        $queryBuilder = Waybill::whereHas('vehicle', function($query) use ($bus_no){
            if($bus_no)
            {
                $query->where('vehicle_registration_number', $bus_no);
            }
        })->with(['trips', 'shifts', 'auditRemittance', 'vehicle', 'trips.route']);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }

        if($depot_id)
        {
            $queryBuilder->where('depot_id', $depot_id);
        }
                
        $queryBuilder = $queryBuilder->orderBy('created_at', 'DESC');

        return $queryBuilder;
    }
}
