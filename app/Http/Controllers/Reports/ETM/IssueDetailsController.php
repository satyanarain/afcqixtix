<?php

namespace App\Http\Controllers\Reports\ETM;

use DB;
use Auth;
use Validator;
use App\Models\Ticket;
use App\Models\Waybill;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;

class IssueDetailsController extends Controller
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
        return view('reports.etm.issue_details.index');
    }

    public function displayData(Request $request)
    {       
        $input = $request->all();
        $depot_id = $input['depot_id'];
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no, $shift_id);
        
        $data = $queryBuilder->paginate(10);

        return view('reports.etm.issue_details.index', compact('data'));
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
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no, $shift_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $etmNo = $this->findNameById('etm_details', 'etm_no', $etm_no);
        $shift = $this->findNameById('shifts', 'shift', $shift_id);

        $shift = $shift ? $shift : 'All';
    
        $title = 'ETM Issue Details Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . $depotName,
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'ETM No. : ' . $etmNo,
            'Shift : ' . $shift
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
        $etm_no = $input['etm_no'];
        $shift_id = $input['shift_id'];

        $queryBuilder = $this->getQueryBuilder($depot_id, $from_date, $to_date, $etm_no, $shift_id);

        $depotName = $this->findNameById('depots', 'name', $depot_id);
        $etmNo = $this->findNameById('etm_details', 'etm_no', $etm_no);
        $shift = $this->findNameById('shifts', 'shift', $shift_id);

        $shift = $shift ? $shift : 'All';
    
        $title = 'ETM Issue Details Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */

        $meta = [ // For displaying filters description on header
            'Depot : ' . ucfirst($depotName),
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'ETM No. : ' . $etmNo,
            'Shift : ' . $shift
        ]; 


        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Abstract Number', 'Waybill Number', 'Route', 'Duty', 'Shift', 'Conductor', 'Vehicle Number', 'ETM No.', 'Issued By', 'Issued To', 'Issuance Timestamp'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)$d->abstract_no, (string)$d->waybill_no, (string)$d->route->route_name, (string)$d->duty->duty_number, (string)$d->shift->shift, (string)$d->conductor->crew_name, (string)$d->vehicle->vehicle_registration_number, (string)$d->etm->etm_no, (string)$d->depotHead->name, (string)$d->conductor->crew_name, (string)date('d-m-Y H:i:s', strtotime($d->etm_issue_time))]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);      
    }

    public function getQueryBuilder($depot_id, $from_date, $to_date, $etm_no, $shift_id)
    {
        $queryBuilder = Waybill::whereHas('etm', function($query) use ($etm_no){
            if($etm_no)
            {
                $query->where('etm_no', $etm_no);
            }
        })->with(['route:id,route_name', 'duty:id,duty_number', 'shift:id,shift', 'depotHead:id,name', 'conductor:id,crew_name', 'vehicle:id,vehicle_registration_number', 'etm:id,etm_no']);

        if($depot_id)
        {
            $queryBuilder = $queryBuilder->where('depot_id', $depot_id);
        }

        if($shift_id)
        {
            $queryBuilder = $queryBuilder->where('shift_id', $shift_id);
        }

        if($from_date && $to_date)
        {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', $from_date)
                                         ->whereDate('created_at', '<=', $to_date);
        }
                
        $queryBuilder = $queryBuilder->orderBy('id', 'ASC');

        return $queryBuilder;
    }
}
