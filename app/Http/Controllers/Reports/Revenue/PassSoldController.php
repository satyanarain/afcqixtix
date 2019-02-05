<?php

namespace App\Http\Controllers\Reports\Revenue;

use DB;
use Auth;
use Validator;
use PdfReport;
use CSVReport;
use ExcelReport;
use App\Models\Crew;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Models\Inspection;
use App\Models\ETMLoginLog;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Models\Denomination;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;

class PassSoldController extends Controller
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
        return view('reports.revenue.pass_sold.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id, $service_id, $pass_id);        
        $data = $queryBuilder->paginate(10);
       			
       	return view('reports.revenue.pass_sold.index', compact('data'));
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
        $depotName = $this->findNameById('depots', 'name', $depot_id); 

        $conductorId = $conductor_id ? $conductor_id : 'All';   
    
        $title = 'Pass Sold Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : '.date('d-m-Y', strtotime($from_date)),
            'To : '.date('d-m-Y', strtotime($to_date)),
            'Conductor ID : '.$conductorId
        ];   

        $reportData = $this->getCalculatedData($depot_id, $from_date, $to_date, $conductor_id);

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name, 'depotName'=>$depotName], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $conductor_id = $input['conductor_id'];

        $data = $this->getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);

        $conductorId = $conductor_id ? $conductor_id : 'All';
    
        $title = 'Pass Sold Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' => $depotName,
            'From : '=> date('d-m-Y', strtotime($from_date)),
            'To : '=> date('d-m-Y', strtotime($to_date)),
            'Conductor ID : '=>$conductorId
        ]; 

      
        $columns = [
                        'Depot'=> function($row){
                            return $depotName;
                        },
                        'No. of Duties'=> function($row){
                            return $row->count();
                        }, 
                        'No. of Trips' => function($row){
                            return $row->trips->count();
                        },
                        'Dist. (Kms)'=> function($row){
                            return $row->trips->pluck('route')->sum('distance');
                        },
                        'PPT Tkt Cnt' => function($row){
                            return $row->tickets->count();
                        }, 
                        'Shift' => function($row){
                            return $row->shift->shift;
                        }, 
                        'Login Timestamp' => function($row){
                            return $row->etmLoginDetails->login_timestamp ? date('d-m-Y H:i:s', strtotime($row->etmLoginDetails->login_timestamp)) : 'Pending';
                        }, 
                        'Logout Timestamp' => function($row){
                            return $row->etmLoginDetails->logout_timestamp ? date('d-m-Y H:i:s', strtotime($row->etmLoginDetails->logout_timestamp)) : 'Pending';
                        }, 
                        'Audit Timestamp' => function($row){
                            return $row->auditRemittance->created_date?date('d-m-Y H:i:s', strtotime($row->auditRemittance->created_date)):'Pending';
                        }, 
                        'Remittance Timestamp' => function($row){
                            return $row->cashCollection->submitted_at?date('d-m-Y H:i:s', strtotime($row->cashCollection->submitted_at)):'Pending';
                        }];

        return ExcelReport::of($title, $meta, $data, $columns)
        					->download($title.'.xlsx');        
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $conductor_id, $service_id, $pass_id)
    {
        $getQueryBuilder = Ticket::whereHas('waybill', function($query) use($depot_id, $service_id){
        	if($depot_id)
        	{
        		$query->where('depot_id', $depot_id);
        	}
            if($service_id)
            {
                $query->where('service_id', $service_id);
            }
        });

        if($from_date && $to_date)
        {
            $getQueryBuilder = $getQueryBuilder->whereDate('created_at', '>=', $from_date)
                                                ->whereDate('created_at', '<=', $to_date);
        }

        return $getQueryBuilder;
    }
}
