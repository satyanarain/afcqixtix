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
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;
use App\Models\Inventory\DepotStockLedger;

class DenominationWiseStockLedgerController extends Controller
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
            'Depot : ' . $depotName, 
            'Denomination : ' . $denomination,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Ticket Type', 'Denomination', 'Date', 'Challan No. / Receipt No.', 'Series', 'Opening Ticket No.', 'Closing Ticket No.', 'Ticket Count', 'Ticket Value', 'Transaction Type', 'Balance Count', 'Balance Value'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)'Ticket', (string)$d->denomination->description, (string)date('d-m-Y', strtotime($d->transaction_date)), (string)$d->challan_no, (string)$d->series, (string)$d->start_sequence, (string)$d->end_sequence, (string)$d->item_quantity, (string)($d->item_quantity * $d->denomination->price), (string)$d->transaction_type, (string)$d->balance_quantity, (string)($d->balance_quantity * $d->denomination->price)]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);
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
