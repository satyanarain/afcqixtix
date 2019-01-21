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
use App\Models\Inventory\CrewSummary;

class CrewStockController extends Controller
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
        return view('reports.ppt.crew_stock.index');
    }

    public function displaydata(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];
        $denom_id = $input['denomination_id'];
        $series = $input['series'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id, $denom_id, $series);

        $data = $queryBuilder->paginate(10);

        return view('reports.ppt.crew_stock.index', compact('data'));
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
        $series = $input['series'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id, $denom_id, $series);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $series = $series ? $series : 'All';
        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Conductor : ' . $conductorName, 
            'Denomination : ' . $denomination,
            'Series : ' . $series
        ];

        //data should be like below data
        /*
        [
            ['col1', 'col2', '...'],
            ['val1', 'val2', '...'],
            ['val1', 'val2', '...'],
            ...
        ]
        */

        $reportData = $queryBuilder->get();

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $conductor_id = $input['conductor_id'];
        $denom_id = $input['denomination_id'];
        $series = $input['series'];

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $denomination = $this->findNameById('denominations', 'description', $denom_id);
    
        $title = 'ETM Audit Status Report'; // Report title
  
    
        $data = CrewSummary::with(['conductor:id,crew_name,crew_id', 'denomination:id,description,price']);

        if($conductor_id)
        {
            $data = $data->where('crew_id', $conductor_id);
        }

        if($series)
        {
            $data = $data->where('series', $series);
        }

        
        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $series = $series ? $series : 'All';
        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Denomination : ' => $denomination,
            'Series : ' => $series
        ]; 
        
                
        $data = $data->where('items_id', 1);

        $columns = [
                        'Ticket Type'=> function($row){
                            return 'Ticket';
                        }, 
                        'Conductor Name (ID)'=> function($row){
                            return $row->conductor->crew_name." (".$row->conductor->crew_id.")";
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
                            return $row->qty;
                        }, 
                        'Ticket Value' => function($row){
                            return $row->qty * $row->denomination->price;
                        }, 
                        'Remark' => function($row){
                            return '';
                        }];

        $title = 'Crew Stock Report'; // Report title

        return ExcelReport::of($title, $meta, $data, $columns)
                    ->editColumns(['Ticket Count', 'Ticket Value'], [
                        'class' => 'right bold',
                    ])->showTotal([
                        'Ticket Count' => 'point',
                        'Ticket Value' => 'point',
                    ])
                    ->download($title.'.xlsx');
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id, $denom_id, $series)
    {
        $queryBuilder = CrewSummary::whereHas('conductor', function($query) use ($depot_id){
                                        $query->where('depot_id', $depot_id);
                                     })
                                     ->with(['conductor:id,crew_name,crew_id', 'denomination:id,description,price']);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }

        if($conductor_id)
        {
            $queryBuilder = $queryBuilder->where('crew_id', $conductor_id);
        }

        if($denom_id)
        {
            $queryBuilder = $queryBuilder->where('denom_id', $denom_id);
        }

        if($series)
        {
            $queryBuilder = $queryBuilder->where('series', $series);
        }        
                
        $queryBuilder = $queryBuilder->where('items_id', 1);

        return $queryBuilder;
    }
}
