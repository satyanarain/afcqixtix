<?php

namespace App\Http\Controllers\Reports\PPT;

use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;
use App\Models\Inventory\DepotSummary;
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
use App\Models\CenterStock;
use App\Models\ReturnCrewStock;

class TicketSectionStockController extends Controller
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
        return view('reports.ppt.ticket_section_stock.index');
    }

    public function displaydata(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $denom_id = $input['denomination_id'];
        $series = $input['series'];
    
        $data = DepotSummary::with(['depot:id,name', 'denomination:id,description,price']);

        if($depot_id)
        {
            $data = $data->where('depot_id', $depot_id);
        }

        if($denom_id)
        {
            $data = $data->where('denom_id', $denom_id);
        }

        if($series)
        {
            $data = $data->where('series', $series);
        }        
                
        $data = $data->where('items_id', 1)
                    ->paginate(10);

        return view('reports.ppt.ticket_section_stock.index', compact('data'));
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
        $denom_id = $input['denomination_id'];
        $series = $input['series'];

        $depotName =$this->findNameById('depots', 'name', $depot_id);
        $denomination =$this->findNameById('denominations', 'description', $denom_id);

        $denomination = $denomination ? $denomination : 'All';
    
        $title = 'Ticket Section Stock'; // Report title  
    
        $data = DepotSummary::with(['depot:id,name', 'denomination:id,description,price']);

        if($depot_id)
        {
            $data = $data->where('depot_id', $depot_id);
        }

        if($denom_id)
        {
            $data = $data->where('denomination_id', $denom_id);
        }

        if($series)
        {
            $data = $data->where('series', $series);
        }
        
                
        $data = $data->where('items_id', 1)
                    ->get();

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $series = $series ? $series : 'All';
        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
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
        $reportData = [];
        foreach ($data as $key => $value) 
        {
            $row = [(string)($key+1), "Ticket", (string)($value->denomination->description), (string)($value->series), (string)($value->start_sequence), (string)($value->end_sequence), (string)($value->qty), (string)($value->qty*$value->denomination->price), ""];

            //return $row;

            array_push($reportData, $row);
        }

        //return $reportData;

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $denom_id = $input['denomination_id'];
        $series = $input['series'];

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $denomination = $this->findNameById('denominations', 'description', $denom_id);

        $denomination = $denomination ? $denomination : 'All';
    
        $title = 'Ticket Section Stock'; // Report title   
    
        $data = DepotSummary::with(['depot:id,name', 'denomination:id,description,price']);

        if($depot_id)
        {
            $data = $data->where('depot_id', $depot_id);
        }

        if($denom_id)
        {
            $data = $data->where('denomination_id', $denom_id);
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

        $title = 'Registered User Report'; // Report title

        return ExcelReport::of($title, $meta, $data, $columns)
                    ->editColumns(['Ticket Count', 'Ticket Value'], [
                        'class' => 'right bold',
                    ])->showTotal([
                        'Ticket Count' => 'point',
                        'Ticket Value' => 'point',
                    ])
                    ->download($title.'.xlsx');
    }
}
