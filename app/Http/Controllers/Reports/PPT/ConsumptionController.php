<?php

namespace App\Http\Controllers\Reports\PPT;

use DB;
use Auth;
use Validator;
use App\Models\Crew;
use App\Models\Shift;
use App\Models\Depot;
use App\Models\Waybill;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Models\AuditInventory;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;


class ConsumptionController extends Controller
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
        return view('reports.ppt.consumption.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $report_type = $input['report_type'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id);

        $data = $queryBuilder->paginate(10);

        return view('reports.ppt.consumption.index', compact('data'));
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
        $denom_id = $input['denomination_id'];
        $report_type = $input['report_type'];
    
        $data = AuditInventory::with(['denomination:id,description,price']);

        if($depot_id)
        {
            $data = $data->where('depot_id', $depot_id);
        }

        if($denom_id)
        {
            $data = $data->where('denom_id', $denom_id);
        } 

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->orderBy('denom_id', 'ASC');

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';
    
        $title = 'Consumption of PPT'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName, 
            'Denomination : ' . $denomination,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ];   

        $reportData = [];

        if($report_type == 'detail')
        {
	        $dates = AuditInventory::whereDate('created_at', '>=', $from_date)
	        				 	->whereDate('created_at', '<=', $to_date)
	        				 	->distinct('created_at')->get(['created_at']);
	        if($dates)
		    {
		       	foreach ($dates as $key => $value) 
		        {
		            $queryBuilder = clone $data;
		            $reportData[date('m/d/Y', strtotime($value->created_at))] = $queryBuilder->whereDate('created_at', date('Y-m-d', strtotime($value->created_at)))
		                                ->get();
		        }
		    } 
		}else{
			$reportData = AuditInventory::with(['denomination:id,description,price'])
								->whereDate('created_at', '>=', $from_date)
	        				 	->whereDate('created_at', '<=', $to_date)
	        				 	->groupBy('denom_id')
   								->selectRaw('*, sum(quantity) as quantity')
   								->get();
		}       

        //return $reportData;

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $report_type = $input['report_type'];
    
        $data = AuditInventory::with(['denomination:id,description,price']);

        if($depot_id)
        {
            $data = $data->where('depot_id', $depot_id);
        }

        if($denom_id)
        {
            $data = $data->where('denom_id', $denom_id);
        } 

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->orderBy('denom_id', 'ASC');

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';
    
        $title = 'Consumption of PPT'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName, 
            'Denomination : ' . $denomination,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $data->get();
      
        $reportColumns = ['S. No', 'Ticket Type', 'Date', 'Denomination', 'Ticket Count', 'Ticket Value'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)'Ticket', (string)date('d-m-Y', strtotime($d->created_at)), (string)$d->denomination->description, (string)$d->quantity, (string)$d->quantity * $d->denomination->price]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);
        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $denom_id)
    {
        $queryBuilder = AuditInventory::with(['denomination:id,description,price']);

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
                
        $queryBuilder = $queryBuilder->orderBy('denom_id', 'ASC');

        return $queryBuilder;
    }
}
