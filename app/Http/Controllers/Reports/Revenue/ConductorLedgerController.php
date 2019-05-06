<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use App\Models\CenterStock;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Models\CashCollection;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class ConductorLedgerController extends Controller
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
        return view('reports.revenue.conductor_ledger.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $collected_by = $input['collected_by'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $collected_by);

        $data = $queryBuilder->paginate(10);

        return view('reports.revenue.conductor_ledger.index', compact('data'));
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
        $collected_by = $input['collected_by'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $collected_by);
        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $collectedBy = $this->findNameById('users', 'name', $collected_by);
        $collectedBy = $collectedBy?$collectedBy:'All';
    
        $title = 'Conductor Ledger Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Collected By. : '.$collectedBy
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
        $collected_by = $input['collected_by'];
    
        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $collected_by);
        $collectedBy = $this->findNameById('users', 'name', $collected_by);

        $collectedBy = $collectedBy?$collectedBy:'All';

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $title = 'Conductor Ledger Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Collected By. : ' => $collectedBy,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 

        $data = $this->getData($depot_id, $from_date, $to_date);  

        $reportColumns = ['S. No', 'Date', 'L. Year', 'Actual', 'Variance', 'Percentage', 'L. Year', 'Actual', 'Variance', 'Percentage', 'L. Year', 'Actual', 'Variance', 'Percentage'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)$d['date'], (string)$d['lastYear']['distance'], (string)$d['currentYear']['distance'], (string)$d['kms']['variance'], (string)$d['kms']['percentage'], (string)$d['lastYear']['totalAmount'], (string)$d['currentYear']['totalAmount'], (string)$d['income']['variance'], (string)$d['income']['percentage'], (string)$d['lastYear']['epkm'], (string)$d['currentYear']['epkm'], (string)$d['epkm']['variance'], (string)$d['epkm']['percentage']]);
        } 

        //return $reportData;

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "Yes");

        $this->downloadExcelFile($fileName);
      
        $columns = [
                        'Collected By'=> function($row){
                            return $row->collector->name;
                        },
                        'Route - Duty - Shift'=> function($row){
                            return $row->waybill->route->route_name.' - '.$row->waybill->duty->duty_number.' - '.$row->waybill->shift->shift;
                        },
                        'Abstract No.'=> function($row){
                            return $row->abstract_no;
                        },
                        'Challan No.' => function($row){
                            return $row->cash_challan_no;
                        }, 
                        'Conductor Name (ID)' => function($row){
                            return $row->waybill->conductor->crew_name.' ('.$row->waybill->conductor->crew_id.')';
                        }, 
                        'Amt. Payable (Rs)' => function($row){
                            return number_format((float)$row->amount_payable, 2, '.', '');
                        }, 
                        'Adjustment Amt. (Rs)' => function($row){
                            return number_format((float)$row->amount_payable, 2, '.', '');
                        }, 
                        'Amt. Payable (Rs)' => function($row){
                            $diff = $row->amount_payable - $row->waybill->auditRemittance->payable_amount;
                            return number_format((float)$diff, 2, '.', '');
                        }, 
                        'Amt. Collected (Rs)' => function($row){
                            return number_format((float)$row->waybill->auditRemittance->payable_amount, 2, '.', '');
                        }, 
                        'Collected On' => function($row){
                            return date('d-m-Y H:i:s', strtotime($row->submitted_at));
                        }];

        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
        					->download($title.'.xlsx');        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $collected_by)
    {
        $queryBuilder = CashCollection::whereHas('waybill', function($query) use ($depot_id){
            if($depot_id)
            {
                $query->where('depot_id', $depot_id);
            }
        })->with(['waybill.route', 'waybill.duty', 'waybill.shift', 'waybill.conductor', 'waybill.auditRemittance', 'collector']);

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('submitted_at', '>=', $from_date)
                                         ->whereDate('submitted_at', '<=', $to_date);
        }

        if($collected_by)
        {
            $queryBuilder->where('collected_by', $collected_by);
        }
                
        $queryBuilder = $queryBuilder->orderBy('submitted_at', 'DESC');

        return $queryBuilder;
    }
}
