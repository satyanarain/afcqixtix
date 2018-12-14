<?php


namespace App\Http\Controllers\Report;
use DB;
use Validator;
use App\Models\Crew;
use App\Models\Depot;
use App\Models\ReturnCrewStock;
use App\Models\CenterStock;
use Illuminate\Http\Request;
use App\Traits\checkPermission;
use App\Http\Controllers\Controller;
use PdfReport;
use ExcelReport;
use CSVReport;
use App\Traits\activityLog;
//use App\Http\Requests\Inventory\ReturnCrewStock\StoreReturnCrewStockRequest;
use App\Http\Requests\Report\ETM\AuditStatus\StoreAuditStatusRequest;
//use App\Http\Requests\Inventory\ReturnCrewStock\UpdateReturnCrewStockRequest;
//use App\Repositories\Inventory\ReturnCrewStock\ReturnCrewStockRepositoryContract;

class AuditStatusController extends Controller
{
    use checkPermission;
    use activityLog;
    protected $crewstock;

//    public function __construct(ReturnCrewStockRepositoryContract $crewstock)
//    {
//        $this->crewstock = $crewstock;
//    }

    /**
     * Index function created for create report form.
     * Created By satya
     * Date 12-12-2018
     */
    public function index()
    {
      return view('report.audit_statuses.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created report.
     * Created By satya
     * Date 12-12-2018
     */
    public function store(StoreAuditStatusRequest $request)
    {
 
       
    $input = $request->all();
    $depot_id = $input[depot_id];
    $report_date = $input[report_date];
    $status_type = $input[status_type];
    $etm_no = $input[etm_no];
    $select_format = $input[select_format];
    $name =$this->findNameById('depots','name',$depot_id);
    
    
    
     exit();
    
    $title = 'Audit Status Report'; // Report title

    $meta = [ // For displaying filters description on header
        'Date' => $report_date ,
        'Status Type' => $status_type,
        'Shift' => $status_type
    ];

//    $queryBuilder = Depot::select(['name', 'balance', 'registered_at']) // Do some querying..
//                       ->whereBetween('registered_at', [$fromDate, $toDate])
//                       ->orderBy($sortBy);
    
    
     $route_master_id = $request->route_id;
       $queryBuilder = DB::table('waybills')
                ->select('*')
                ->leftjoin('depots', 'depots.id', '=', 'waybills.depot_id')
                ->leftjoin('shifts', 'shifts.id', '=', 'waybills.shift_id')
                //->leftjoin('stops', 'route_details.stop_id', '=', 'stops.id')
                ///->leftjoin('route_master', 'route_master.id', '=', 'routes.route_number')
                //->where('routes.route_number',$request->route_id)  
                ->orderBy('waybills.id');
                //->get();
        //echo '<pre>';        print_r($routes);die;
        //return view('routes.index',compact('routes','route_master_id'));
    
    

    $columns = [ // Set Column to be displayed
        'Name' => 'name',
        //'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
        'Created At' => 'created_at',
//        'Status' => function($result) { // You can do if statement or any action do you want inside this closure
//            return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
//        }
    ];

    // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
    return PdfReport::of($title, $meta, $queryBuilder, $columns)
//                    ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
//                        'displayAs' => function($result) {
//                            return $result->registered_at->format('d M Y');
//                        },
//                        'class' => 'left'
//                    ])
//                    ->editColumns(['Total Balance', 'Status'], [ // Mass edit column
//                        'class' => 'right bold'
//                    ])
//                    ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
//                        'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
//                    ])
                   // ->limit(20) // Limit record to be showed
                    ->download($title); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
        
      // $stock = $this->crewstock->create($request);

     return redirect()->route('report.audit_statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

   
}
