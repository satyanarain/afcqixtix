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
use App\Models\ETMLoginLog;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Models\Denomination;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class CrewWiseCollectionController extends Controller
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
        return view('reports.revenue.crew_wise_collection.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];

        $depotName = $this->findNameById('depots', 'name', $depot_id);        
        $consolidatedData = $this->getCalculatedData($depot_id, $from_date, $to_date, $conductor_id);
       			
       	return view('reports.revenue.crew_wise_collection.index', compact('consolidatedData', 'depotName'));
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
        $depotName = $this->findNameById('depots', 'name', $depot_id); 

        $conductorId = $conductor_id ? $conductor_id : 'All';   
    
        $title = 'Crew-wise Revenue Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Conductor ID : '.$conductorId
        ];   

        $reportData = $this->getCalculatedData($depot_id, $from_date, $to_date, $conductor_id);

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name, 'depotName'=>$depotName], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];

        $data = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);

        $conductorId = $conductor_id ? $conductor_id : 'All';
    
        $title = 'Crew-wise Revenue Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date)),
            'Conductor ID : '=>$conductorId
        ]; 

      
        $columns = [
                        'Depot'=> function($row){
                            return $depotName;
                        },
                        'No. of Duties'=> function($row){
                            return $row->count();
                        }, 
                        'No. of Trips' => function($row){
                            return $row->trips->count();
                        },
                        'Dist. (Kms)'=> function($row){
                            return $row->trips->pluck('route')->sum('distance');
                        },
                        'PPT Tkt Cnt' => function($row){
                            return $row->tickets->count();
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

    public function getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id)
    {
        $getQueryBuilder = Waybill::whereHas('conductor', function($query) use($conductor_id){
        	if($conductor_id)
        	{
        		$query->where('crew_id', $conductor_id);
        	}
        })->with(['route:id,route_name', 'duty:id,duty_number', 'auditRemittance:waybill_number,created_date', 'cashCollection:abstract_no,submitted_at', 'tickets.concession', 'trips.route', 'auditInventory', 'payouts:abstract_no,amount']);

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

    public function getCalculatedData($depot_id, $from_date, $to_date, $conductor_id)
    {
        $paperPassDenomsArray = Denomination::where('denomination_master_id', 2)->get(['id'])->pluck('id')->toArray();
        $paperTicketDenomsArray = Denomination::where('denomination_master_id', 1)->get(['id'])->pluck('id')->toArray();

        $inspectorsOfDepot = Crew::where([['role', 'Inspector'], ['depot_id', $depot_id]])->get(['id'])->pluck('id')->toArray();

        $penalty_amount = Inspection::whereDate('created_at', '>=', $from_date)
                                    ->whereDate('created_at', '<=', $to_date)
                                    ->whereIn('inspector_id', $inspectorsOfDepot)
                                    ->sum('penalty_amount');

        $getQueryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id);

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
        $epurseAmt = 0;

        foreach($data as $key=>$value)
        {
            $numberOfTrips = $value->trips->count();
            $totalDistance = $value->trips->pluck('route')->sum('distance');
            $totalETMTkts = 0;
            $totalETMTotalPsnger = $value->tickets->count('adults') + $value->tickets->count('childs');
            $totalETMTktsSum = 0;
            $totalETMPassCnt = 0;
            $totalETMPassSum = 0;
            $EP = 0;
            $tickets = $value->tickets;
            $cnci = 0;
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
                    if($concesPercentage)
                    {
                    	$conces = ($concesPercentage/(100 -$concesPercentage))*$tkt->total_amt;
                    }else{
                    	$conces = 0;
                    }
                    
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

            $value->payout = $value->payouts->sum('amount');

            $trips += (int)$numberOfTrips;
            $distance += (int)$totalDistance;
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
            $epurseAmt += $EP;
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
        $consolidatedData['totalCash'] = $totalETMTktsSum + $totalETMPassSum + $totalPaperTktsSum + $totalPaperPassSum;
        $consolidatedData['penalty_amount'] = $penalty_amount;
        $consolidatedData['epurseAmt'] = $epurseAmt;
        $consolidatedData['totalAmt'] = $epurseAmt + $consolidatedData['totalCash'];

        return $consolidatedData;
    }
}
