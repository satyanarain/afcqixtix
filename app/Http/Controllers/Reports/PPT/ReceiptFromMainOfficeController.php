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
use App\Http\Controllers\Controller;
use App\Models\Inventory\DepotStock;

class ReceiptFromMainOfficeController extends Controller
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
        return view('reports.ppt.receipt_from_main_office.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $orderBy = $input['order_by'];
    
        $data = DepotStock::with(['item:id,name', 'depotHead:id,name', 'denomination:id,description,price']);

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
                
        $data = $data->where('items_id', 1)
        			->orderBy($orderBy, 'asc')
                    ->paginate(10);

        //return response()->json($data);

        return view('reports.ppt.receipt_from_main_office.index', compact('data'));
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
        $orderBy = $input['order_by'];

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';
    
        $title = 'Receipt From Main Office'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName, 
            'Denomination : ' . $denomination,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date))
        ];   
    
        $data = DepotStock::with(['item:id,name', 'depotHead:id,name', 'denomination:id,description,price']);

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
                
        $data = $data->where('items_id', 1)
        			->orderBy($orderBy, 'asc');

        $reportData = [];

        $dates = DepotStock::whereDate('created_at', '>=', $from_date)
        				 	->whereDate('created_at', '<=', $to_date)
        				 	->distinct('created_at')->get(['created_at']);

        if($dates)
        {
            foreach ($dates as $key => $value) 
            {
                $queryBuilder = clone $data;
                $reportData[date('m-d-Y', strtotime($value->created_at))] = $queryBuilder->whereDate('created_at', date('Y-m-d', strtotime($value->created_at)))
                                                ->get();
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
        $denom_id = $input['denomination_id'];
        $orderBy = $input['order_by'];

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';
    
        $title = 'Receipt From Main Office'; // Report title

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
    
        $data = DepotStock::with(['item:id,name', 'depotHead:id,name', 'denomination:id,description,price']);

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
                
        $data = $data->where('items_id', 1)
        			->orderBy($orderBy, 'asc');

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
                        'Received By' => function($row){
                            return $row->depotHead->name;
                        }];

        return ExcelReport::of($title, $meta, $data, $columns)
                    ->editColumns(['Ticket Count', 'Ticket Value'], [
                        'class' => 'right bold',
                    ])->showTotal([
                        'Ticket Count' => 'point',
                        'Ticket Value' => 'point',
                    ])->groupBy('Date')
                    ->download($title.'.xlsx');
    }
}
