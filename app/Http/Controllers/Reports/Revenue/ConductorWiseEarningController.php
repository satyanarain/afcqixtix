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

class ConductorWiseEarningController extends Controller
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
        $conductorId = $conductor_id ? $conductor_id : 'All';
    
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
            'Conductor ID. : '.$conductorId
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
        $conductorId = $conductor_id ? $conductor_id : 'All';
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $title = 'Conductor-wise Earning Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Conductor ID. : ' . $conductorId,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Conductor Name (ID)', 'Revenue (Rs)', 'No. of Trips', 'No. of Shifts', 'Average Cash Collection (Rs)'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            $tripsCount = $d->trips ? $d->trips->count() :'0';
            $shiftsCount = $d->shifts ? $d->shifts->count() :'0';
            if($d->shifts && $d->shifts->count() > 0)
            {
                $avg = $d->auditRemittance->payable_amount / $d->shifts->count();
            }else{
                $avg = 0;
            }
            $conductorDetail = $d->conductor->crew_name.' ('.$d->conductor->crew_id.')';
            $payableAmount = number_format((float)$d->auditRemittance->payable_amount, 2, '.', '');

            array_push($reportData, [(string)($key+1), (string)$conductorDetail, (string)$payableAmount, (string)$tripsCount, (string)$shiftsCount, (string)$avg]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);        
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
