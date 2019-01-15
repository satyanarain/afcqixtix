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
use App\Models\RouteMaster;
use App\Models\ETMLoginLog;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Models\Denomination;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class RouteWiseCollectionController extends Controller
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
        return view('reports.revenue.route_wise_collection.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $route_id = $input['route_id'];
        $depotName = $this->findNameById('depots', 'name', $depot_id);    

        $data = $this->getCalculatedData($depot_id, $from_date, $to_date, $route_id);

        $finalData = $data['finalData'];
        $routes = $data['routes'];
       			
       	return view('reports.revenue.route_wise_collection.index', compact('finalData', 'depotName', 'routes'));
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
    
        $title = 'Route-wise Revenue Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date))
        ];   

        $reportData = $this->getCalculatedData($depot_id, $from_date, $to_date);

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name, 'depotName'=>$depotName], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $pending_activity = $input['pending_activity'];

        $data = $this->getQueryBuilder($depot_id, $from_date, $to_date, $pending_activity);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Route-wise Revenue Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date)),
            'Pending Activity : '=>ucfirst($pending_activity)
        ]; 

      
        $columns = [
                        'Date'=> function($row){
                            return date('d-m-Y', strtotime($row->date));
                        },
                        'ETM No.'=> function($row){
                            return $row->etm->etm_no;
                        }, 
                        'Conductor ID' => function($row){
                            return $row->conductor->crew_id;
                        },
                        'Route'=> function($row){
                            return $row->route->route_name;
                        },
                        'Duty' => function($row){
                            return $row->duty->duty_number;
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

    public function getQueryBuilder($depot_id, $from_date, $to_date, $route_id)
    {
        $getQueryBuilder = Waybill::with(['route:id,route_name', 'duty:id,duty_number', 'auditRemittance:waybill_number,created_date', 'cashCollection:abstract_no,submitted_at', 'tickets.concession', 'trips.route', 'auditInventory', 'payouts:abstract_no,amount', 'conductor:id,crew_id']);

        if($depot_id)
        {
            $getQueryBuilder = $getQueryBuilder->where('depot_id', $depot_id);
        }

        if($from_date && $to_date)
        {
            $getQueryBuilder = $getQueryBuilder->whereDate('created_at', '>=', $from_date)
                                                ->whereDate('created_at', '<=', $to_date);
        }

        if($route_id)
        {
        	$getQueryBuilder = $getQueryBuilder->where('route_id', $route_id);
        }

        $getQueryBuilder = $getQueryBuilder->orderBy('route_id', 'ASC')
        									->orderBy('created_at', 'DESC');
        									//->groupBy('route_id');

        return $getQueryBuilder;
    }

    public function getCalculatedData($depot_id, $from_date, $to_date, $route_id)
    {
        $paperTicketDenomsArray = Denomination::where('denomination_master_id', 1)->get(['id'])->pluck('id')->toArray();

        $inspectorsOfDepot = Crew::where([['role', 'Inspector'], ['depot_id', $depot_id]])->get(['id'])->pluck('id')->toArray();

        $penalty_amount = Inspection::whereDate('created_at', '>=', $from_date)
                                    ->whereDate('created_at', '<=', $to_date)
                                    ->whereIn('inspector_id', $inspectorsOfDepot)
                                    ->sum('penalty_amount');

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $route_id);    
        
        $data = $queryBuilder->get();
        $consolidatedData = [];
        $routes = RouteMaster::pluck('id')->toArray();

        foreach ($routes as $key => $route) 
        {
        	foreach ($data as $key => $d) 
        	{
        		if($d->route_id == $route)
        		{
        			$routeWiseData[] = $d;
        		}
        	}

        	$consolidatedData[$route] = $routeWiseData;
        }

        $finalData = [];

        foreach ($consolidatedData as $keyo => $value) 
        {
        	if($value)
        	{
        		foreach ($value as $keyi => $val) 
        		{
        			$finalData[$keyo][$keyi]['route'] = $val->route->route_name;
        			$finalData[$keyo][$keyi]['date'] = date('d/m/Y', strtotime($val->created_at));
        			$finalData[$keyo][$keyi]['duty'] = $val->duty->duty_number;
        			$finalData[$keyo][$keyi]['trips'] = $val->trips->count();
        			$finalData[$keyo][$keyi]['crew_id'] = $val->conductor->crew_id;
        			$tickets = $val->tickets;
        			$EP = 0;
		            $cnci = 0;
		            $totalETMPassCnt = 0;
		            $totalETMPassSum = 0;
		            $totalETMTkts = 0;
		            $totalETMTktsSum = 0;
		            foreach ($tickets as $key => $tkt) 
		            {
		                if($tkt->ticket_type == 'ETMPass')
		                {
		                    $totalETMPassCnt++;
		                    $totalETMPassSum += (int)$tkt->total_amt;
		                }else if($tkt->ticket_type == 'Ticket'){
		                    $totalETMTkts++;
		                    $totalETMTktsSum += (int)$tkt->total_amt;
		                }else if($tkt->ticket_type == 'EPurse')
		                {
		                    $EP += (int)$tkt->total_amt;
		                }

		                if($tkt->concession->flat_fare == 'No')
		                {
		                    $concesPercentage = (int)$tkt->concession->percentage;
		                    //return $concesPercentage;
		                    $conces = ($concesPercentage/(100 -$concesPercentage))*$tkt->total_amt;
		                }else{
		                    $conces = (int)$tkt->concession->flat_fare_amount;
		                }

		                $cnci += $conces;
		            }

		            $totalPaperTkts = $val->auditInventory;
		            $TPT = 0;
		            $TPTS = 0;
		            $TPP = 0;
		            $TPPS = 0;
		            foreach ($totalPaperTkts as $key => $ppt) 
		            {
		                if(in_array($ppt->denom_id, $paperTicketDenomsArray))
		                {
		                    $TPT += $ppt->quantity;
		                    $TPTS += (int)$ppt->sold_ticket_value;
		                }else{
		                    $TPP += $ppt->quantity;
		                    $TPPS += $ppt->sold_ticket_value;
		                }
		            }

		            $payout = $val->payouts->sum('amount');
        			$finalData[$keyo][$keyi]['totalETMTkts'] = $totalETMTkts;
        			$finalData[$keyo][$keyi]['totalETMTktsSum'] = $totalETMTktsSum;
        			$finalData[$keyo][$keyi]['totalETMPassCnt'] = $totalETMPassCnt;
        			$finalData[$keyo][$keyi]['totalETMPassSum'] = $totalETMPassSum;
        			$finalData[$keyo][$keyi]['EP'] = $EP;
        			$finalData[$keyo][$keyi]['cnci'] = $cnci;

        			$finalData[$keyo][$keyi]['TPT'] = $TPT;
        			$finalData[$keyo][$keyi]['TPTS'] = $TPTS;
        			$finalData[$keyo][$keyi]['TPP'] = $TPP;
        			$finalData[$keyo][$keyi]['TPPS'] = $TPPS;
        			$finalData[$keyo][$keyi]['payout'] = $payout;
        		}
        	}
        }

        return ['finalData'=>$finalData, 'routes'=>$routes];
    }
}
