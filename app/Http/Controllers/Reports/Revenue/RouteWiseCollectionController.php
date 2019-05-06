<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use CSVReport;
use PdfReport;
use Validator;
use ExcelReport;
use App\Models\Crew;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\Inspection;
use App\Models\ETMLoginLog;
use App\Models\RouteMaster;
use App\Traits\activityLog;
use App\Models\Denomination;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class RouteWiseCollectionController extends Controller
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
        $route_id = $input['route_id'];
        $depotName = $this->findNameById('depots', 'name', $depot_id);    

        $data = $this->getCalculatedData($depot_id, $from_date, $to_date, $route_id);

        $finalData = $data['finalData'];
        $routes = $data['routes'];
    
        $title = 'Route-wise Revenue Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date))
        ];

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$finalData, 'routes'=>$routes, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name, 'depotName'=>$depotName], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $route_id = $input['route_id'];

        $depotName = $this->findNameById('depots', 'name', $depot_id);    
        $title = 'Route-wise Revenue Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $this->getCalculatedData($depot_id, $from_date, $to_date, $route_id);

        $finalData = $data['finalData'];
        $routes = $data['routes'];
      
        $reportColumns = ['S. No', 'Route', 'Date', 'Duty No.', 'No. of Trips', 'Crew ID', 'PPT Ticket Count', 'PPT Ticket Amount (Rs)', 'PPT Pass Sold Count', 'PPT Pass Sold Amount (Rs)', 'ETM Ticket Count', 'ETM Ticket Amount (Rs)', 'ETM Pass Sold Count', 'ETM Pass Sold Amount (Rs)', 'Payout Amount (Rs)', 'Fine Amount (Rs)', 'Dist. (Kms)', 'Cash (Rs)', 'E-Purse (Rs)', 'Total Amount (Rs)', 'Concession Amount (Rs)'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach($routes as $key=>$route)
        {
            $routeData = $finalData[$route];
            foreach($routeData as $keyi=> $rdata)
            {   
                $route = $rdata['route'];
                $date = $rdata['date'];
                $duty = $rdata['duty'];
                $trips = $rdata['trips'];
                $crew_id = $rdata['crew_id'];
                $TPT = $rdata['TPT'];
                $TPTS = number_format((float)$rdata['TPTS'], 2, '.', '');
                $TPP = $rdata['TPP'];
                $TPPS = number_format((float)$rdata['TPPS'], 2, '.', '');
                $totalETMTkts = $rdata['totalETMTkts'];
                $totalETMTktsSum = number_format((float)$rdata['totalETMTktsSum'], 2, '.', '');
                $totalETMPassCnt = $rdata['totalETMPassCnt'];
                $totalETMPassSum = number_format((float)$rdata['totalETMPassSum'], 2, '.', '');
                $payout = number_format((float)$rdata['payout'], 2, '.', '');
                $penalty_amount = number_format((float)$rdata['penalty_amount'], 2, '.', '');
                $distance = number_format((float)$rdata['distance'], 2, '.', '');
                $totalCash = number_format((float)$rdata['totalCash'], 2, '.', '');
                $EP = number_format((float)$rdata['EP'], 2, '.', '');
                $totalAmt = number_format((float)$rdata['totalAmt'], 2, '.', '');
                $cnci = number_format((float)$rdata['cnci'], 2, '.', '');

                array_push($reportData, [(string)($key+1), (string)$route, (string)$date, (string)$duty, (string)$trips, (string)$crew_id, (string)$TPT, (string)$TPTS, (string)$TPP, (string)$TPPS, (string)$totalETMTkts, (string)$totalETMTktsSum, (string)$totalETMPassCnt, (string)$totalETMPassSum, (string)$payout, (string)$penalty_amount, (string)$distance, (string)$totalCash, (string)$EP, (string)$totalAmt, (string)$cnci]);
            }
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);
        
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
		                    $conces = $tkt->concession_amt;
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
                    $distance = $val->trips->pluck('route')->sum('distance');
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

                    $finalData[$keyo][$keyi]['totalCash'] = $TPTS + $TPPS + $totalETMTktsSum + $totalETMPassSum;
                    $finalData[$keyo][$keyi]['totalAmt'] = $TPTS + $TPPS + $totalETMTktsSum + $totalETMPassSum + $EP;
                    $finalData[$keyo][$keyi]['penalty_amount'] = $penalty_amount;
                    $finalData[$keyo][$keyi]['distance'] = $distance;
        		}
        	}
        }

        return ['finalData'=>$finalData, 'routes'=>$routes];
    }
}
