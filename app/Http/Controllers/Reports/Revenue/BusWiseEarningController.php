<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use App\Models\Waybill;
use App\Models\CenterStock;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class BusWiseEarningController extends Controller
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
            'Depot : ' . $depotName,
            'Bus No. : ' . $bus_no,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Date', 'Bus No.', 'No. of Shifts', 'No. of Trips', 'Total Km.', 'Total Amt. (Rs)'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)date('d-m-Y', strtotime($d->created_at)), (string)$d->vehicle->vehicle_registration_number, (string)number_format((float)$d->shifts->count(), 2, '.', ''), (string)number_format((float)$d->trips->count(), 2, '.', ''), (string)number_format((float)$d->trips->pluck('route')->sum('distance'), 2, '.', ''), number_format((float)$d->auditRemittance->payable_amount, 2, '.', '')]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $bus_no)
    {
        $queryBuilder = Waybill::with(['trips', 'shifts', 'auditRemittance', 'vehicle', 'trips.route']);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }

        if($depot_id)
        {
            $queryBuilder->where('depot_id', $depot_id);
        }

        if($bus_no)
        {
            $queryBuilder->where('vehicle_id', $bus_no);
        }
                
        $queryBuilder = $queryBuilder->orderBy('created_at', 'DESC');

        return $queryBuilder;
    }
}
