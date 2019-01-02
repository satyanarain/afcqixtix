<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Ticket;
use App\Traits\activityLog;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class PassesValidatedDetailsController extends Controller
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
        return view('reports.etm.passes_validated_details.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
    
        $data = Ticket::with(['fromStop', 'toStop', 'concession:id,flat_fare_amount']);

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->where('ticket_type', 'Pass')
        			 ->orderBy('id', 'ASC')
        			 ->paginate(10);

        return view('reports.etm.passes_validated_details.index', compact('data'));
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
    
        $data = Ticket::with(['fromStop', 'toStop', 'concession:id,flat_fare_amount']);

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->where('ticket_type', 'Pass')
        			->orderBy('id', 'ASC');

        $depotName = $this->findNameById('depots', 'name', $depot_id);
    
        $title = 'Passes Validated Details Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)).' To : '.date('d-m-Y', strtotime($to_date))
        ];   

        $reportData = $data->get();      

        //return $reportData;

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
    
        $data = Ticket::with(['fromStop', 'toStop', 'concession:id,flat_fare_amount']);

        if($from_date && $to_date)
        {
        	$data = $data->whereDate('created_at', '>=', $from_date)
        				 ->whereDate('created_at', '<=', $to_date);
        }
                
        $data = $data->where('ticket_type', 'Pass')
        			->orderBy('id', 'ASC');

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        if($route_id)
        {
        	$routeName = $this->findNameById('route_master', 'route_name', $route_id);
        }else{
        	$routeName = 'All';
        }
    
        $title = 'Passes Validated Details Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'Route : ' => $routeName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date))
        ]; 

      
        $columns = [
                        'From Stop'=> function($row){
                            return $row->fromStop->short_name;
                        },
                        'To Stop'=> function($row){
                            return $row->toStop->short_name;
                        },
                        'Date and Time'=> function($row){
                            return date('d-m-Y H:i:s', strtotime($row->sold_at));
                        },
                        'Adult Count' => function($row){
                            return $row->adults;
                        }, 
                        'Adult Amount (Rs.)' => function($row){
                            return $row->adults_amt;
                        }, 
                        'Child Count' => function($row){
                            return $row->childs;
                        }, 
                        'Child Amount (Rs.)' => function($row){
                            return $row->childs_amt;
                        }, 
                        'Concession' => function($row){
                            return $row->concession->flat_fare_amount;
                        }, 
                        'Pass' => function($row){
                            return '0.00';
                        }, 
                        'Cash' => function($row){
                            return '0.00';
                        }, 
                        'E-Purse' => function($row){
                            return '0.00';
                        }, 
                        'Total Amount (Rs.)' => function($row){
                            return '0.00';
                        }, 
                        'Card Number' => function($row){
                            return $row->card_number;
                        }];

        return ExcelReport::of($title, $meta, $data, $columns)
        					->download($title.'.xlsx');        
    }
}
