<?php

namespace App\Http\Controllers\Reports\PPT;

use Auth;
use App\Traits\activityLog;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Traits\GenerateExcelTrait;
use App\Http\Controllers\Controller;
use App\Models\Inventory\{CenterSummary};

class MainOfficeSummaryController extends Controller
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
        return view('reports.ppt.main_office_summary.index');
    }

    public function displaydata(Request $request)
    {       
        $input = $request->all();
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $series = $input['series'];
    
        $queryBuilder = $this->getQueryBuilder($from_date, $to_date, $denom_id, $series);

        $data = $queryBuilder->paginate(10);

        return view('reports.ppt.main_office_summary.index', compact('data'));
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
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $series = $input['series'];
    
        $queryBuilder = $this->getQueryBuilder($from_date, $to_date, $denom_id, $series);
        $denomination = $this->findNameById('denominations', 'description', $denom_id);
        $denomination = $denomination ? $denomination : "All";

        $title = 'Main Office Summary Report'; // Report title

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $series = $series ? $series : 'All';
        $meta = [ // For displaying filters description on header
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)), 
            'Denomination : ' . $denomination,
            'Series : ' . $series
        ];

        $reportData = $queryBuilder->get();

        return response()->json(['status'=>'Ok', 'title'=>$title, 'meta'=>$meta, 'data'=>$reportData, 'serverDate'=>date('d-m-Y H:i:s'), 'takenBy'=>Auth::user()->name], 200);
    }

    public function getExcelReport(Request $request)
    {
        $input = $request->all();
        $from_date = date('Y-m-d', strtotime($input['from_date']));
        $to_date = date('Y-m-d', strtotime($input['to_date']));
        $denom_id = $input['denomination_id'];
        $series = $input['series'];

        $denomination = $this->findNameById('denominations', 'description', $denom_id);    
        $title = 'Main Office Summary Report'; // Report title
        $queryBuilder = $this->getQueryBuilder($from_date, $to_date, $denom_id, $series);

        /*
        *meta data shoul be an array as below
        *['Depot : Balewadi', 'ETM No. : 1222', 'ETC.']
        */
        $series = $series ? $series : 'All';
        $meta = [ // For displaying filters description on header
            'From : ' . date('d-m-Y', strtotime($from_date)),
            'To : ' . date('d-m-Y', strtotime($to_date)),
            'Denomination : ' . $denomination,
            'Series : ' . $series
        ]; 

        $data = $queryBuilder->get();
      
        $reportColumns = ['S. No', 'Depot Name', 'Item Type', 'Denomination', 'Series', 'Quantity'];

        $reportData = [];
        array_push($reportData, $reportColumns);

        foreach ($data as $key => $d) 
        {
            array_push($reportData, [(string)($key+1), (string)$d->depot->name, (string)$d->item->description, (string)$d->denomination->description, (string)$d->series, (string)$d->qty]);
        } 

        $fileName = public_path().'/abcd/'.$title.'.xlsx';        

        $this->generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, "No");

        $this->downloadExcelFile($fileName); 

        unlink($fileName);
    }

    public function getQueryBuilder($from_date, $to_date, $denom_id, $series)
    {
        $queryBuilder = CenterSummary::with(['denomination:id,description,price', 'item:id,description']);

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
