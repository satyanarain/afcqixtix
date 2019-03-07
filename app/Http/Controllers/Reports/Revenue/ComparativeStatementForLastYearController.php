<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use URL;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Waybill;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class ComparativeStatementForLastYearController extends Controller
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
        return view('reports.revenue.comparative_statement_for_last_year.index');
    }

    public function displayData(Request $request)
    {     
        //return $this->excelReportHeaderString();  
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));

        $data = $this->getData($depot_id, $from_date, $to_date);

        return view('reports.revenue.comparative_statement_for_last_year.index', compact('data'));
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
    
        $title = 'Comparative Statement for Last Year Report'; // Report title

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

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$data, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Comparative Statement for Last Year Report'; // Report title

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

        $string = $this->stringGenerator($data);

        $fileName = public_path().'/abcd/test.xlsx';

        file_put_contents($fileName, $string);

        $file = $fileName;
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit();
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

    public function getWaybills($depot_id, $date)
    {
        $queryBuilder = Waybill::with('route');

        if($date)
        {
            $queryBuilder->whereDate('created_at', date('Y-m-d', strtotime($date)));
        }

        if($depot_id)
        {
            $queryBuilder->where('depot_id', $depot_id);
        }

        return $queryBuilder->get(['abstract_no']);
    }

    public function getData($depot_id, $from_date, $to_date)
    {
        $begin = new DateTime(date('Y-m-d', strtotime($from_date)));
        $end = new DateTime(date('Y-m-d', strtotime($to_date)));

        $interval = DateInterval::createFromDateString('1 day');
        $dates = new DatePeriod($begin, $interval, $end);

        $data = [];

        foreach ($dates as $key => $date) 
        {
            $date = $date->format('Y-m-d');
            $explodedDate = explode('-', $date);
            $arr = [$explodedDate[0]-1, $explodedDate[1], $explodedDate[2]];
            $lastYearDate = implode('-', $arr);
        
	        $totalAmountCY = 0;
	        $distanceCY = 0;
            $totalAmountLY = 0;
            $distanceLY = 0;

	        $waybills = $this->getWaybills($depot_id, $date);

	        if($waybills)
	        {
	            foreach ($waybills as $keyc => $waybill) 
	            {
	                $waybillDetail = $this->getWaybillDetail($waybill->abstract_no);
	                if($waybillDetail)
	                {            
	                    $distanceCY += $waybillDetail->trips->pluck('route')->sum('distance');
	                    $totalAmountCY += $waybillDetail->total_amt;
	                }
	            }
	        }

            $data[$key]['date'] = date('d/m', strtotime($date));
	        $data[$key]['currentYear']['distance'] = $distanceCY;            
            $data[$key]['currentYear']['totalAmount'] = $totalAmountCY;
            if($distanceCY)
            {
                $data[$key]['currentYear']['epkm'] = $totalAmountCY/$distanceCY;
            }else
            {
                if($totalAmountCY)
                    $data[$key]['currentYear']['epkm'] = 100;
                else
                    $data[$key]['currentYear']['epkm'] = 0;
            }
            


            $waybills = $this->getWaybills($depot_id, $lastYearDate);

            if($waybills)
            {
                foreach ($waybills as $keyl => $waybill) 
                {
                    $waybillDetail = $this->getWaybillDetail($waybill->abstract_no);
                    if($waybillDetail)
                    {            
                        $distanceLY += $waybillDetail->trips->pluck('route')->sum('distance');
                        $totalAmountLY += $waybillDetail->total_amt;
                    }
                }
            }

            $data[$key]['lastYear']['distance'] = $distanceLY;
            $data[$key]['lastYear']['totalAmount'] = $totalAmountLY;
            if($distanceLY)
            {
                $data[$key]['lastYear']['epkm'] = $totalAmountLY/$distanceLY;
            }else{
                if($totalAmountLY)
                    $data[$key]['lastYear']['epkm'] = 100;
                else
                    $data[$key]['lastYear']['epkm'] = 0;
            }

            $data[$key]['kms']['variance'] = $distanceCY - $distanceLY;
            if($distanceCY)
            {
                $data[$key]['kms']['percentage'] = ($distanceCY - $distanceLY)/$distanceCY*100;
            }else{
                if($distanceCY - $distanceLY)
                    $data[$key]['kms']['percentage'] = 100;
                else
                    $data[$key]['kms']['percentage'] = 0;
            }
            

            $data[$key]['income']['variance'] = $totalAmountCY - $totalAmountLY;
            if($totalAmountCY)
            {
                $data[$key]['income']['percentage'] = ($totalAmountCY - $totalAmountLY)/$totalAmountCY*100;
            }else{
                if($totalAmountCY - $totalAmountLY)
                    $data[$key]['income']['percentage'] = 100;
                else
                    $data[$key]['income']['percentage'] = 0;
            }
            

            $data[$key]['epkm']['variance'] = $data[$key]['currentYear']['epkm'] - $data[$key]['lastYear']['epkm'];
            if($data[$key]['currentYear']['epkm'])
            {
                $data[$key]['epkm']['percentage'] = $data[$key]['epkm']['variance']/$data[$key]['currentYear']['epkm']*100;
            }else{
                if($data[$key]['epkm']['variance'])
                    $data[$key]['epkm']['percentage'] = 100;
                else
                    $data[$key]['epkm']['percentage'] = 0;
            }
            
	    }        

        return $data;
    }


    public function stringGenerator($data)
    {
        $string = "<table class='table'>";
        $string .= "<thead>";
        $string .= "<tr>";
        $string .= "<th></th><th></th><th colspan='4'>KMS</th><th colspan='4'>Income</th><th colspan='4'>EPKM</th>";
        $string .= "</tr>";
        $string .= "<tr>";
        $string .= "<th>S. No.</th><th>Date</th><th class='text-right'>L. Year</th><th>Actual</th><th>Variance</th><th>Percentage</th><th>L. Year</th><th>Actual</th><th>Variance</th><th>Percentage</th><th>L. Year</th><th>Actual</th><th>Variance</th><th>Percentage</th>";
        $string .= "</tr>";
        $string .= "</thead>";
        $string .= "<tbody>";

        foreach ($data as $key => $d) 
        {
            $string .= "<tr>";
            $string .= "<td>".($key+1)."</td><td>".$d['date']."</td><td>".$d['lastYear']['distance']."</td><td>".$d['currentYear']['distance']."</td><td>".$d['kms']['variance']."</td><td>".$d['kms']['percentage']."</td><td>".$d['lastYear']['totalAmount']."</td><td>".$d['currentYear']['totalAmount']."</td><td>".$d['income']['variance']."</td><td>".$d['income']['percentage']."</td><td>".$d['lastYear']['epkm']."</td><td>".$d['currentYear']['epkm']."</td><td>".$d['epkm']['variance']."</td><td>".$d['epkm']['percentage']."</td>";
            $string .= "</tr>";
        }    

        $string .= "</tbody>"; 
        $string .= "</table>";

        $headerString = $this->excelReportHeaderString();

        return $headerString.$string;
    }

    public function excelReportHeaderString()
    {
        $logo = URL::to('images/logo.png');
        $string = "<table class='table'>";
        $string .= "<tr>";
        $string .= "<th colspan='4'><img src='".$logo."' alt='Logo'></th><th colspan='8'>QixTix | Automated Fare Collection System</td>";
        $string .= "</tr>";
        $string .= "</table>";

        return $string;
    }
}
