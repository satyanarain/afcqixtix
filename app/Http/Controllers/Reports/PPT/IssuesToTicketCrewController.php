<?php

namespace App\Http\Controllers\Reports\PPT;

use DB;
use Auth;
use Validator;
use App\Models\Crew;
use App\Models\Depot;
use App\Models\Shift;
use App\Models\Waybill;
use App\Models\CenterStock;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Models\ReturnCrewStock;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Models\Inventory\CrewStock;
use App\Http\Controllers\Controller;

class IssuesToTicketCrewController extends Controller
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
        return view('reports.ppt.issues_to_crew.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];
        $denom_id = $input['denomination_id'];
        $orderBy = $input['order_by'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $conductor_id, $orderBy);
        $data = $queryBuilder->orderBy($orderBy, 'asc')
                    ->paginate(10);

        return view('reports.ppt.issues_to_crew.index', compact('data'));
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
        $denom_id = $input['denomination_id'];
        $orderBy = $input['order_by'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $conductor_id, $orderBy);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';
    
        $title = 'Issues To Crew'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName, 
            'Denomination : ' . $denomination,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date))
        ];   

        $reportData = [];

        if($orderBy == 'denom_id')
        {
        	$denominations = CrewStock::with(['denomination:id,description'])
        					->whereDate('created_at', '>=', $from_date)
        				 	->whereDate('created_at', '<=', $to_date)
        				 	->distinct('denom_id')->get(['denom_id']);
        	if($denominations)
	        {
	            foreach ($denominations as $key => $value) 
	            {
	                $queryBuilder = clone $queryBuilder;
	                $reportData[$value->denomination->description] = $queryBuilder->where('denom_id', $value->denom_id)
	                                                ->get();
	            }
	        }

        }else{
        	$dates = CrewStock::whereDate('created_at', '>=', $from_date)
        				 	->whereDate('created_at', '<=', $to_date)
        				 	->distinct('created_at')->get(['created_at']);
        	if($dates)
	        {
	            foreach ($dates as $key => $value) 
	            {
	                $queryBuilder = clone $queryBuilder;
	                $reportData[date('m/d/Y', strtotime($value->created_at))] = $queryBuilder->whereDate('created_at', date('Y-m-d', strtotime($value->created_at)))
	                                                ->get();
	            }
	        }
        }

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];
        $denom_id = $input['denomination_id'];
        $orderBy = $input['order_by'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $conductor_id, $orderBy)
        			 ->orderBy($orderBy, 'ASC');

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id);
        $denomination = $this->findNameById('denominations', 'description', $denom_id);

        $conductorName = $conductorName ? $conductorName : "All";
        $denomination = $denomination ? $denomination : "All"; 
    
        $title = 'Issues To Crew'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . ucfirst($depotName), 
            'Denomination : ' . $denomination,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ];  

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Ticket Type', 'Date', 'Denomination', 'Series', 'Opening Ticket No.', 'Closing Ticket No.', 'Ticket Count', 'Ticket Value', 'Issued By', 'Received By'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)'Ticket', (string)date('d-m-Y', strtotime($d->created_at)), (string)$d->denomination->description, (string)$d->series, (string)$d->start_sequence, (string)$d->end_sequence, (string)$d->quantity, (string)($d->quantity * $d->denomination->price), (string)$d->issuedBy->name, (string)$d->conductor->crew_name]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $conductor_id, $orderBy)
    {
        $queryBuilder = CrewStock::with(['depot:id,name', 'item:id,name', 'conductor:id,crew_name,crew_id', 'denomination:id,description,price', 'issuedBy:id,name']);

        if($depot_id)
        {
            $queryBuilder = $queryBuilder->where('depot_id', $depot_id);
        }

        if($denom_id)
        {
            $queryBuilder = $queryBuilder->where('denom_id', $denom_id);
        } 

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }

        if($conductor_id)
        {
            $queryBuilder = $queryBuilder->where('crew_id', $conductor_id);
        }
                
        $queryBuilder = $queryBuilder->where('items_id', 1);
        //$queryBuilder = $queryBuilder->groupBy($groupBy);

        return $queryBuilder;
    }
}
