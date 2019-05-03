<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use App\Models\Ticket;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Models\CashCollection;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class ConcessionCollectionController extends Controller
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
        return view('reports.revenue.concession_collection.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $service_id = $input['service_id'];
        $concession_id = $input['concession_id'];
        $conductor_id = $input['conductor_id'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $service_id, $concession_id, $conductor_id);

        $data = $queryBuilder->paginate(10);

        return view('reports.revenue.concession_collection.index', compact('data'));
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
        $service_id = $input['service_id'];
        $concession_id = $input['concession_id'];
        $conductor_id = $input['conductor_id'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $service_id, $concession_id, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $serviceName = $this->findNameById('services', 'name', $service_id);
        $concessionType = $this->findNameById('concessions', 'description', $concession_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id);

        $serviceName = $serviceName ? $serviceName : 'All';
        $concessionType = $concessionType ? $concessionType : 'All';
        $conductorName = $conductor_id ? $conductor_id : 'All';
    
        $title = 'Concession Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Service : '.$serviceName,
            'Conductor ID : '.$conductorName
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
        $service_id = $input['service_id'];
        $concession_id = $input['concession_id'];
        $conductor_id = $input['conductor_id'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $service_id, $concession_id, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $serviceName = $this->findNameById('services', 'name', $service_id);
        $concessionType = $this->findNameById('concessions', 'description', $concession_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id);

        $serviceName = $serviceName ? $serviceName : 'All';
        $concessionType = $concessionType ? $concessionType : 'All';
        $conductorName = $conductor_id ? $conductor_id : 'All';
        $title = 'Concession Collection Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'Service : ' . $serviceName,
            'Conductor ID : ' . $conductorName
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Concession Type', 'Passenger Count', 'Actual Fare', 'Charged Fare', 'Rebate Amount'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)$d->concession->description, (string)$d->passenger_count, (string)number_format((float)$d->actual_fare, 2, '.', ''), (string)number_format((float)$d->charged_fare, 2, '.', ''), (string)number_format((float)$d->concession_amount, 2, '.', '')]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $service_id, $concession_id, $conductor_id)
    {
        $queryBuilder = Ticket::whereHas('waybill', function($query) use ($depot_id, $service_id, $conductor_id){
            if($depot_id)
            {
                $query->where('depot_id', $depot_id);
            }

            if($service_id)
            {
            	$query->where('service_id', $service_id);
            }

            if($conductor_id)
            {
            	$query->whereHas('conductor', function($q) use($conductor_id){
            		$q->where('crew_id', $conductor_id);
            	});
            }
        })->with(['concession:id,description'])
        ->groupBy('concession_id')
        ->selectRaw(DB::raw("SUM(adults+childs) as passenger_count, SUM(concession_amt+total_amt) as actual_fare, SUM(concession_amt) as concession_amount, concession_id, SUM(total_amt) as charged_fare"));

        if($concession_id)
        {
        	$queryBuilder = $queryBuilder->where('concession_id', $concession_id);
        }

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }
                
        $queryBuilder = $queryBuilder;

        return $queryBuilder;
    }
}
