<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use App\Models\Waybill;
use App\Traits\activityLog;
use App\Models\CenterStock;
use App\Models\RouteDetail;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class RouteWiseSummaryController extends Controller
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
        return view('reports.revenue.route_wise_summary.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $route_id = $input['route_id'];

        $routeName = $this->findNameById('route_master', 'route_name', $route_id);

        $data = $this->getData($routeName, $depot_id, $from_date, $to_date, $route_id);

        return view('reports.revenue.route_wise_summary.index', compact('data'));
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
        $route_id = $input['route_id'];

        $routeName = $this->findNameById('route_master', 'route_name', $route_id);
        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Route Wise Summary Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Route : '.$routeName
        ];   

        $reportData = $this->getData($routeName, $depot_id, $from_date, $to_date, $route_id);

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $route_id = $input['route_id'];

        $routeName = $this->findNameById('route_master', 'route_name', $route_id);
        $depotName = $this->findNameById('depots', 'name', $depot_id);

        $title = 'Route Wise Summary Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : '. $depotName,
            'From : '. date('d-m-Y', strtotime($from_date)),
            'To : '. date('d-m-Y', strtotime($to_date)),
            'Route Name : ' . $routeName
        ]; 

        $data = $this->getData($routeName, $depot_id, $from_date, $to_date, $route_id);
      
        $reportColumns = ['S. No', 'Route', 'Distance', 'Sch. Trips ', 'Oper. Trips', 'Sch. KMS', 'Oper. KMS', 'Income (Rs)', 'EPKM ETM', 'PPT Tkts/Pass', 'ETM Pasngr'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)$d['route'], (string)$d['distance'], (string)$d['tripsCount'], (string)$d['tripsCount'], (string)$d['distance'], (string)$d['distance'], (string)$d['totalAmount'], (string)$d['epkm'], (string)$d['ticketsCount'], (string)$d['passengersCount']]);
        } 

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

    public function getWaybills($depot_id, $from_date, $to_date, $route_id)
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

       	if($route_id)
		{
		 	$queryBuilder->where('route_id', $route_id);
		}

        return $queryBuilder->get(['abstract_no']);
    }

    public function getData($routeName, $depot_id, $from_date, $to_date, $route_id)
    {
    	$data = [];
        $ticketsCount = 0;
        $tripsCount = 0;
        $passengersCount = 0;
        $totalAmount = 0;
        $distance = 0;

        $waybills = $this->getWaybills($depot_id, $from_date, $to_date, $route_id);

        if($waybills)
        {
        	foreach ($waybills as $key => $waybill) 
        	{
        		$waybillDetail = $this->getWaybillDetail($waybill->abstract_no);
        		if($waybillDetail)
        		{
        			$ticketsCount += $waybillDetail->tickets->count();
        			$tripsCount += $waybillDetail->trips->count();
        			$distance += $waybillDetail->trips->pluck('route')->sum('distance');
        			$passengersCount += $waybillDetail->passenger_count;
        			$totalAmount += $waybillDetail->total_amt;
        		}
        	}
        }

        if($distance)
        {
            $epkm = $totalAmount/$distance;
        }else{
            $epkm = 0;
        }        

        $data = array(0=>array('ticketsCount'=>$ticketsCount, 'tripsCount'=>$tripsCount, 'passengersCount'=>$passengersCount, 'totalAmount'=>$totalAmount, 'distance'=>$distance, 'route'=>$routeName, 'epkm'=>$epkm));

        return $data;
    }
}
