<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use URL;
use Auth;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\TripStart;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class TripSheetController extends Controller
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
        return view('reports.revenue.trip_sheet.index');
    }

    public function displayData(Request $request)
    {     
        //return $this->excelReportHeaderString();  
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));

        $data = $this->getData($depot_id, $from_date, $to_date);

        return view('reports.revenue.trip_sheet.index', compact('data'));
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
        $duty_id = $input['duty_id'];

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $routeName = $this->findNameById('route_master', 'route_name', $route_id);
        $dutyName = $this->findNameById('duties', 'duty_number', $duty_id);
    
        $title = 'Trip Sheet Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Route/Duty : '. $routeName.'/'.$dutyName
        ];        

        $data = $this->getData($depot_id, $from_date, $to_date, $route_id, $duty_id);

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$data, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $route_id = $input['route_id'];
        $duty_id = $input['duty_id'];

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $routeName = $this->findNameById('route_master', 'route_name', $route_id);
        $dutyName = $this->findNameById('duties', 'duty_number', $duty_id);
    
        $title = 'Trip Sheet Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Route/Duty : '. $routeName.'/'.$dutyName
        ];        

        $data = $this->getData($depot_id, $from_date, $to_date, $route_id, $duty_id);

        $reportColumns = ['Ticket No.', 'End Stop', 'Time', 'Adults Count', 'Adults Amt (Rs)', 'Child Count', 'Child Amt (Rs)', 'Concession (Rs)', 'Pass', 'Cash', 'E-Purse', 'Total Amt (Rs)', 'Pass Type', 'Card Number', 'E-Purse Balance'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $dkey => $d) 
        {
            $trips = $d['trips'];

            foreach ($trips as $trkey => $trip) 
            {
                $tickets = $trip->tickets;

                if(count($tickets))
                {
                    array_push($reportData, ['Trip No. : '.$trip->trip_id, (string)$trip->start_timestamp, 'Route : '.$trip->routeMaster->route_name, 'Path : '.$trip->direction, $trip->fromStop->stop.' To '.$trip->toStop->stop, '', '', '', '', '', '', '', '', '', '']);
                    array_push($reportData, ['Stage : '.$trip->fromStop->stop, '', '', '', '', '', '', '', '', '', '', '', '', '', '']);
                }

                foreach ($tickets as $tikey => $ticket) 
                {
                    array_push($reportData, [(string)$ticket->ticket_number, (string)$ticket->toStop->stop, (string)$ticket->sold_at, (string)$ticket->adults, (string)$ticket->adults_amt, (string)$ticket->childs, (string)$ticket->childs_amt, (string)$ticket->concession_amt, (string)0, (string)0, (string)0, (string)$ticket->total_amt, (string)'', (string)$ticket->card_number, (string)$ticket->epurse_balance]);
                }
            }
        } 

        //return $reportData;

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName);
    }

    public function getData($depot_id, $from_date, $to_date, $route_id, $duty_id)
    {
        $begin = new DateTime(date('Y-m-d', strtotime($from_date)));
        $end = new DateTime(date('Y-m-d', strtotime($to_date)));

        $interval = DateInterval::createFromDateString('1 day');
        $dates = new DatePeriod($begin, $interval, $end);

        $data = [];

        foreach ($dates as $key => $date) 
        {
            $date = $date->format('Y-m-d');
            $trips = TripStart::with(['waybill:abstract_no,conductor_id', 'waybill.conductor:id,crew_id,crew_name', 'tickets.toStop:id,stop', 'fromStop:id,stop', 'toStop:id,stop', 'routeMaster:id,route_name'])
                              //->where([['route_master_id', $route_id]])
                              ->whereDate('start_timestamp', $date)
                              ->get(); 
            $data[$date]['trips'] = $trips;
        }

        return $data;
    }
}
