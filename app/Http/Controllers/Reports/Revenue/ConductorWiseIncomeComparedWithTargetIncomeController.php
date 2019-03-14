<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use App\Models\Crew;
use App\Models\Waybill;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class ConductorWiseIncomeComparedWithTargetIncomeController extends Controller
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
        return view('reports.revenue.conductor_wise_income_compared_with_target_income.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $data = $this->getData($depot_id, $from_date, $to_date);

        return view('reports.revenue.conductor_wise_income_compared_with_target_income.index', compact('data'));
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
        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Conductor-wise Income Compared With Target Income Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date))
        ];   

        $data = $this->getData($depot_id, $from_date, $to_date);

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$data, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name, 'route_id'=>$route_id, 'duties'=>$duties], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $depotName = $this->findNameById('depots', 'name', $depot_id);

        $title = 'Conductor-wise Income Compared With Target Income Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 
      
        $data = $this->getData($depot_id, $from_date, $to_date);

        $reportColumns = ['S. No', 'Conductor ID', 'Conductor Name', 'No. of Duties', 'KMS', 'Self EPKM', 'Traget EPKM', 'Variance', 'Profit/Loss'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)$d->crew_id, (string)$d->crew_name, (string)$d->no_of_duties, (string)$d->distance, (string)$d->actualEPKM, (string)$d->targetEPKM, (string)$d->variance, (string)$d->profit]);
        } 

        //return $reportData;

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName);        
    }

    public function getWaybillDetail($waybill_no)
    {
        $queryBuilder = Waybill::with(['tickets', 'shifts', 'routeNotMaster', 'trips.route'])
                                ->withCount(['tickets as passenger_count'=>function($query){
                                    $query->select(DB::raw("(SUM(adults) + SUM(childs))"));
                                }])->withCount(['tickets as tickets_count'])
                                ->withCount(['tickets as total_amt'=>function($q){
                                    $q->select(DB::raw("SUM(total_amt)"));
                                }])
                                ->where('abstract_no', $waybill_no);

        return $queryBuilder->first();
    }

    public function getWaybills($depot_id, $from_date, $to_date, $crew_id)
    {
        $queryBuilder = Waybill::with('route');

        if($from_date && $to_date)
        {
            $queryBuilder->whereDate('created_at', '>=', $from_date)
                         ->whereDate('created_at', '<=', $to_date);
        }

        if($depot_id)
        {
            $queryBuilder->where('depot_id', $depot_id);
        }

        if($crew_id)
        {
            $queryBuilder->where('conductor_id', $crew_id);
        }

        return $queryBuilder->get(['abstract_no']);
    }

    public function getData($depot_id, $from_date, $to_date)
    {
        $crews = Crew::where([['depot_id', $depot_id], ['role', 'Conductor']])->get(['id', 'crew_id', 'crew_name']);

        foreach ($crews as $key => $crew) 
        {
        	$duties = 0;
	        $targetEPKM = 0;
	        $passengersCount = 0;
	        $totalAmount = 0;
	        $distance = 0;

	        $waybills = $this->getWaybills($depot_id, $from_date, $to_date, $crew->id);

	        if($waybills)
	        {
	            foreach ($waybills as $key => $waybill) 
	            {
	                $waybillDetail = $this->getWaybillDetail($waybill->abstract_no);
	                if($waybillDetail)
	                {
	                    $duties++;	              
	                    $distance += $waybillDetail->trips->pluck('route')->sum('distance');
	                    $totalAmount += $waybillDetail->total_amt;

	                    $target = Target::where([['route_id', $waybill->route_id], ['duty_id', $waybill->duty_id]])->first();

	                    $targetEPKM += $target->epkm;
	                }
	            }
	        }

	        $crew->no_of_duties = $duties;
	        $crew->distance = $distance;

	        if($duties > 0)
	        {
	        	$targetEPKM = $targetEPKM/$duties;
	        }else{
	        	$targetEPKM = 0;
	        }

	        $crew->targetEPKM = $targetEPKM;

	        if($distance != 0)
	        {
	            $actualEPKM = $totalAmount/$distance;
	        }else{
	            $actualEPKM = 0;
	        }

	        $crew->actualEPKM = $actualEPKM;

	        $crew->variance = $actualEPKM - $targetEPKM;

	        $crew->profit = $crew->variance * $distance;
	    }        

        return $crews;
    }

}
