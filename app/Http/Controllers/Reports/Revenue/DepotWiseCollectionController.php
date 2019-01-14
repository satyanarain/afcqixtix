<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\ETMLoginLog;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Models\Denomination;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class DepotWiseCollectionController extends Controller
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
        return view('reports.revenue.depot_wise_collection.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $depotName = $this->findNameById('depots', 'name', $depot_id);

        //return $paperPassMasterId = $this->findNameById('denomination_masters', 'id', 'Pass');
        //$paperTicketMasterId = $this->findNameById('denomination_masters', 'id', 'Ticket');

        $paperPassDenomsArray = Denomination::where('denomination_master_id', 2)->get(['id'])->pluck('id')->toArray();
        $paperTicketDenomsArray = Denomination::where('denomination_master_id', 1)->get(['id'])->pluck('id')->toArray();

        $getQueryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date);

        $data = $getQueryBuilder->get();  

        $consolidatedData = [];

        $duties = 0;
        $trips = 0;
        $distance = 0;
        $totalETMTkts = 0;
        $totalETMTotalPsnger = 0;
        $totalETMTktsSum = 0;
        $totalPaperTkts = 0;
        $totalPaperTktsSum = 0;
        $totalPaperPass = 0;
        $totalPaperPassSum = 0;
        $payout = 0;
        $concession = 0;

        foreach($data as $key=>$value)
        {
        	//$value->numberOfDuties = $data->count();
        	$value->numberOfTrips = $value->trips->count();
        	$value->totalDistance = $value->trips->pluck('route')->sum('distance');
        	$totalETMTkts = 0;
        	$totalETMTotalPsnger = $value->tickets->count('adults') + $value->tickets->count('childs');
        	$totalETMTktsSum = 0;
            $totalETMPassCnt = 0;
            $totalETMPassSum = 0;
            $tickets = $value->tickets;
            $cnci = 0;
            foreach ($tickets as $key => $tkt) 
            {
                if($tkt->ticket_type == 'Pass')
                {
                    $totalETMPassCnt++;
                    $totalETMPassSum += (int)$tkt->total_amt;
                }else{
                    $totalETMTkts++;
                    $totalETMTktsSum += (int)$tkt->total_amt;
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


            $totalPaperTkts = $value->auditInventory;
            $TPT = 0;
            $TPTS = 0;
            $TPP = 0;
            $TPPS = 0;
            foreach ($totalPaperTkts as $key => $value) 
            {
                if(in_array($value->denom_id, $paperTicketDenomsArray))
                {
                    $TPT += $value->quantity;
                    $TPTS += (int)$value->sold_ticket_value;
                }else{
                    $TPP += $value->quantity;
                    $TPPS += $value->sold_ticket_value;
                }
            }

            //$value->payout = $value->payouts->sum('amount');

        	$trips += (int)$value->numberOfTrips;
        	$distance += (int)$value->totalDistance;
        	$totalETMTkts += $value->totalETMTkts;
        	$totalETMTotalPsnger += $value->totalETMTotalPsnger;
        	$totalETMTktsSum += $value->totalETMTktsSum;
        	$totalPaperTkts += $TPT;
        	$totalPaperTktsSum += $TPTS;
            $totalPaperPass += $TPP;
            $totalPaperPassSum += $TPPS;
            $payout += (int)$value->payout;
            $concession += $cnci;
        	$duties++; 
        }

        //payoutes
        $consolidatedData['duties'] = $duties;
        $consolidatedData['trips'] = $trips;
        $consolidatedData['distance'] = $distance;
        $consolidatedData['totalETMTkts'] = $totalETMTkts;
        $consolidatedData['totalETMTotalPsnger'] = $totalETMTotalPsnger;
        $consolidatedData['totalETMTktsSum'] = $totalETMTktsSum;
        $consolidatedData['totalETMPassCnt'] = $totalETMPassCnt;
        $consolidatedData['totalETMPassSum'] = $totalETMPassSum;
        $consolidatedData['totalPaperTkts'] = $totalPaperTkts;
        $consolidatedData['totalPaperTktsSum'] = $totalPaperTktsSum;
        $consolidatedData['totalPaperPass'] = $totalPaperPass;
        $consolidatedData['totalPaperPassSum'] = $totalPaperPassSum;
        $consolidatedData['payout'] = $payout;
        $consolidatedData['concession'] = $concession;
        $consolidatedData['totalSum'] = $concession;

        //return $data;
       			
       	return view('reports.revenue.depot_wise_collection.index', compact('consolidatedData', 'depotName'));
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
        $pending_activity = $input['pending_activity'];

        $getQueryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $pending_activity);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Depot-wise Revenue Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date)),
            'Pending Activity : '.ucfirst($pending_activity)
        ];   

        $reportData = $getQueryBuilder->get();   

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
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
    
        $title = 'Depot-wise Revenue Collection Report'; // Report title

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

    public function getQueryBuilder($depot_id, $from_date, $to_date)
    {
        $getQueryBuilder = Waybill::with(['route:id,route_name', 'duty:id,duty_number', 'auditRemittance:waybill_number,created_date', 'cashCollection:abstract_no,submitted_at', 'tickets.concession', 'trips.route', 'auditInventory', 'payouts:abstract_no,amount']);

        if($depot_id)
        {
            $getQueryBuilder = $getQueryBuilder->where('depot_id', $depot_id);
        }

        if($from_date && $to_date)
        {
            $getQueryBuilder = $getQueryBuilder->whereDate('created_at', '>=', $from_date)
                                                ->whereDate('created_at', '<=', $to_date);
        }

        return $getQueryBuilder;
    }
}
