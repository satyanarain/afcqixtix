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
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;
use App\Models\Inventory\DepotStockLedger;

class DenominationWiseStockLedgerController extends Controller
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
        return view('reports.ppt.denomination_wise_stock_ledger.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $ledger = $input['ledger'];
        $conductor_id = $input['conductor_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $ledger, $conductor_id);
        
        $data = $queryBuilder->paginate(10);

        return view('reports.ppt.denomination_wise_stock_ledger.index', compact('data'));
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
        $ledger = $input['ledger'];
        $conductor_id = $input['conductor_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $ledger, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';
    
        $title = 'Denomination wise Stock Ledger'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName, 
            'Denomination : ' . $denomination,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date))
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
        $denom_id = $input['denomination_id'];
        $ledger = $input['ledger'];
        $conductor_id = $input['conductor_id'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $ledger, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $conductorName = $this->findNameById('crew', 'crew_name', $conductor_id) ? $this->findNameById('crew', 'crew_name', $conductor_id) : 'All';
        $denomination = $this->findNameById('denominations', 'description', $denom_id) ? $this->findNameById('denominations', 'description', $denom_id) : 'All';
    
        $title = 'Denomination wise Stock Ledger'; // Report title

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
                        'Denomination' => function($row){
                            return $row->denomination->description;
                        },
                        'Date'=> function($row){
                            return date('d-m-Y', strtotime($row->transaction_date));
                        },
                        'Challan No. / Receipt No.' => function($row){
                            return $row->challan_no;
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
                            return $row->item_quantity;
                        }, 
                        'Ticket Value' => function($row){
                            return $row->item_quantity * $row->denomination->price;
                        },
                        'Transaction Type' => function($row){
                            return $row->transaction_type;
                        }, 
                        'Balance Count' => function($row){
                            return $row->balance_quantity;
                        }, 
                        'Balance Value' => function($row){
                            return $row->balance_quantity * $row->denomination->price;
                        }];

        	return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumns(['Ticket Count', 'Ticket Value', 'Balance Count', 'Balance Value'], [
                        'class' => 'right bold',
                    ])
                    ->download($title.'.xlsx');
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $denom_id, $ledger, $conductor_id)
    {
        $queryBuilder = DepotStockLedger::with(['denomination:id,description,price', 'item:id,name']);

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
                
        $queryBuilder = $queryBuilder->orderBy('denom_id', 'ASC')
                     ->orderBy('created_at', 'ASC')
                     ->select('depot_id', 'denom_id', 'challan_no', 'series', 'start_sequence', 'end_sequence', 'item_quantity', 'balance_quantity', 'transaction_type', 'item_id', 'transaction_date');

        return $queryBuilder;
    }
}
