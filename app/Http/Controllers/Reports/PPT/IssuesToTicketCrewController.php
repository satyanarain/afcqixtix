<?php

namespace App\Http\Controllers\Reports\PPT;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Crew;
use App\Models\Shift;
use App\Models\Depot;
use App\Models\Waybill;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Models\ReturnCrewStock;
use App\Traits\checkPermission;
use App\Models\Inventory\CrewStock;
use App\Http\Controllers\Controller;

class IssuesToTicketCrewController extends Controller
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
    
        $data = CrewStock::with(['depot:id,name', 'item:id,name', 'conductor:id,crew_name,crew_id', 'denomination:id,description,price', 'issuedBy:id,name']);

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

        if($conductor_id)
        {
        	$data = $data->where('crew_id', $conductor_id);
        }
                
        $data = $data->where('items_id', 1)
        			->orderBy($orderBy, 'asc')
                    ->paginate(10);

        //return response()->json($data);

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
    
        $data = CrewStock::with(['depot:id,name', 'item:id,name', 'conductor:id,crew_name,crew_id', 'denomination:id,description,price', 'issuedBy:id,name']);

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

        if($conductor_id)
        {
        	$data = $data->where('crew_id', $conductor_id);
        }

        $data = $data->where('items_id', 1);

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
	                $queryBuilder = clone $data;
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
	                $queryBuilder = clone $data;
	                $reportData[date('m/d/Y', strtotime($value->created_at))] = $queryBuilder->whereDate('created_at', date('Y-m-d', strtotime($value->created_at)))
	                                                ->get();
	            }
	        }
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
        $conductor_id = $input['conductor_id'];
        $denom_id = $input['denomination_id'];
        $orderBy = $input['order_by'];
    
        $data = CrewStock::with(['depot:id,name', 'item:id,name', 'conductor:id,crew_name,crew_id', 'denomination:id,description,price', 'issuedBy:id,name']);

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

        if($conductor_id)
        {
        	$data = $data->where('crew_id', $conductor_id);
        }

        $data = $data->where('items_id', 1)
        			 ->orderBy($orderBy, 'ASC');

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';
    
        $title = 'Issues To Crew'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName, 
            'Denomination : ' => $denomination,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ];   

        $columns = [
                        'Ticket Type'=> function($row){
                            return 'Ticket';
                        },
                        'Date'=> function($row){
                            return date('d-m-Y', strtotime($row->created_at));
                        },
                        'Denomination' => function($row){
                            return $row->denomination->description;
                        }, 
                        'Series' => function($row){
                            return $row->series;
                        }, 
                        'Opening Ticket No.' => function($row){
                            return $row->start_sequence;
                        }, 
                        'Closing Ticket No.' => function($row){
                            return $row->end_sequence;
                        }, 
                        'Ticket Count' => function($row){
                            return $row->quantity;
                        }, 
                        'Ticket Value' => function($row){
                            return $row->quantity * $row->denomination->price;
                        }, 
                        'Issued By' => function($row){
                            return $row->issuedBy->name;
                        }, 
                        'Received By' => function($row){
                            return $row->conductor->crew_name;
                        }];

        if($orderBy == 'created_at')
        {
        	$groupBy = 'Date';
        }else{
        	$groupBy = 'Denomination';
        }

        return ExcelReport::of($title, $meta, $data, $columns)
                    ->editColumns(['Ticket Count', 'Ticket Value'], [
                        'class' => 'right bold',
                    ])->showTotal([
                        'Ticket Count' => 'point',
                        'Ticket Value' => 'point',
                    ])->groupBy($groupBy)
                    ->download($title.'.xlsx');
    }
}
