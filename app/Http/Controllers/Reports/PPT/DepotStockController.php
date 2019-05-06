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
use App\Http\Controllers\Controller;
use App\Models\Inventory\DepotSummary;

class DepotStockController extends Controller
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
        return view('reports.ppt.depot_stock.index');
    }

    public function displaydata(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $series = $input['series'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $series);
        $data = $queryBuilder->paginate(10);

        return view('reports.ppt.depot_stock.index', compact('data'));
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
        $series = $input['series'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $series);

        $depotName =$this->findNameById('depots', 'name', $depot_id);
        $denomination =$this->findNameById('denominations', 'description', $denom_id);

        $denomination = $denomination ? $denomination : 'All';
    
        $title = 'Ticket Section Stock'; // Report title  
    
        
        $data = $queryBuilder->get();

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $series = $series ? $series : 'All';
        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Denomination : ' . $denomination,
            'Series : ' . $series,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
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
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $series = $input['series'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $series);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $denomination = $this->findNameById('denominations', 'description', $denom_id);

        $denomination = $denomination ? $denomination : 'All';
    
        $title = 'Ticket Section Stock'; // Report title  
        
        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $series = $series ? $series : 'All';
        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'Denomination : ' . $denomination,
            'Series : ' . $series,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ];

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Ticket Type', 'Denomination', 'Series', 'Opening Ticket No.', 'Closing Ticket No.', 'Ticket Count', 'Ticket Value', 'Remark'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)'Ticket', (string)$d->denomination->description, (string)$d->series, (string)$d->start_sequence, (string)$d->end_sequence, (string)$d->qty, (string)($d->qty * $d->denomination->price), (string)""]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName);

        /*$columns = [
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

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumns(['Ticket Count', 'Ticket Value'], [
                        'class' => 'right bold',
                    ])->showTotal([
                        'Ticket Count' => 'point',
                        'Ticket Value' => 'point',
                    ])
                    ->download($title.'.xlsx');*/
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $series)
    {
        $queryBuilder = DepotSummary::with(['depot:id,name', 'denomination:id,description,price']);

        if($depot_id)
        {
            $queryBuilder = $queryBuilder->where('depot_id', $depot_id);
        }

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
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
