<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Waybill;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Waybill\UpdateWaybillRequest;
use App\Http\Requests\Waybill\StoreWaybillRequest;
use App\Repositories\Waybill\WaybillRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\activityLog;
use App\Traits\Ac;
use App\Traits\checkPermission;
//use Illuminate\Support\Facades\Validator;
class WaybillController extends Controller
{
    protected $waybills;
 
    use activityLog;
    use checkPermission;
    public function __construct(
        WaybillRepositoryContract $waybills
    ) {
        $this->waybills = $waybills;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('waybills','view'))
            return redirect()->route('401');
        $waybills = DB::table('waybills')
                ->select('waybills.*','waybills.id as id','depots.name as depot_name','shifts.shift','route_master.route_name',
                        'duties.duty_number','services.name as service_name','bus_types.bus_type','vehicles.vehicle_registration_number')
                ->leftjoin('depots','depots.id','waybills.depot_id')
                ->leftjoin('shifts','shifts.id','waybills.shift_id')
                ->leftjoin('route_master','route_master.id','waybills.route_id')
                ->leftjoin('duties','duties.id','waybills.duty_id')
                ->leftjoin('services','services.id','waybills.service_id')
                ->leftjoin('bus_types','bus_types.id','waybills.bus_type_id')
                ->leftjoin('vehicles','vehicles.id','waybills.vehicle_id')
                ->where('status','=','g')
                ->orderBy('waybills.id','desc')->count();
        //echo '<pre>';        print_r($waybills);die;
    return view('waybills.index',compact('waybills'));
   
    }
    public function create()
    {
        if(!$this->checkActionPermission('waybills','create'))
            return redirect()->route('401');
        //$depot = Waybill::findOrFail();
        $unique_number = $this->generateUniqueNumber();
        //echo str_pad(random_int(0, 99999999), 6, '0', STR_PAD_LEFT);die;
        return view('waybills.create', compact('unique_number'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Waybill $depot
     * @return Response
     */
    public function store(StoreWaybillRequest $waybillRequest)
    {
        if(!$this->checkActionPermission('waybills','create'))
            return redirect()->route('401');
        //echo '<pre>';print_r($waybillRequest->all());die;
        $getInsertedId = $this->waybills->create($waybillRequest);
        return redirect()->route('waybills.index');         
    }
    /**
     * Display the specified resource.
     *
     * @create by satya  int  $id
     * @date 20-02-2018
     */
   public function show($id)
   {
       if(!$this->checkActionPermission('waybills','view'))
            return redirect()->route('401');
        $waybills = DB::table('waybills')->select('*','waybills.id as id')
            ->leftjoin('depots','depots.id','waybills.depot_id')
            ->where('waybills.id',$id)
             ->orderBy('waybills.id','desc')
          ->first();
        return view('waybills.index',compact('waybills'))->withWaybills($depot);
   
     }

    /**
     * Display the specified resource.
     *
     * @created by satya 
     * @date 20-02-2018
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('waybills','edit'))
            return redirect()->route('401');
       $waybills = DB::table('waybills')->select('*','waybills.id as id','depots.id as depot_id')
            ->leftjoin('depots','depots.id','waybills.depot_id')
            ->where('waybills.id',$id)
            ->orderBy('waybills.id','desc')
               ->first();
       $vehicles = DB::table('vehicles')
            ->where('depot_id', '=',$waybills->depot_id)
            ->orderBy('vehicle_registration_number','asc')
            ->pluck('vehicle_registration_number', 'id');
       $duties = DB::table('duties')
            ->where('route_id', '=',$waybills->route_id)
            ->orderBy('duty_number','asc')
            ->pluck('duty_number', 'id');
       $services = DB::table('services')
            ->where('bus_type_id', '=',$waybills->bus_type_id)
            ->orderBy('name','asc')
            ->pluck('name', 'id');
            //->get(); 
       //echo '<pre>';print_r($query);die;
        return view('waybills.edit',compact('waybills','vehicles','duties','services'));
    }

    /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    public function update($id, UpdateWaybillRequest $request)
    {
        if(!$this->checkActionPermission('waybills','edit'))
            return redirect()->route('401');
        $this->waybills->update($id, $request);
        return redirect()->route('waybills.index');
    }

   /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    
      public function viewDetail($id) {
          if(!$this->checkActionPermission('waybills','view'))
            return redirect()->route('401');
       $res = DB::table('waybills')
                ->select('users.user_name','waybills.id as id','depots.name as depot_name','shifts.shift','route_master.route_name',
                        'duties.duty_number','services.name as service_name','bus_types.bus_type','vehicles.vehicle_registration_number','waybills.*')
                ->leftjoin('depots','depots.id','waybills.depot_id')
                ->leftjoin('shifts','shifts.id','waybills.shift_id')
                ->leftjoin('route_master','route_master.id','waybills.route_id')
                ->leftjoin('duties','duties.id','waybills.duty_id')
                ->leftjoin('services','services.id','waybills.service_id')
                ->leftjoin('bus_types','bus_types.id','waybills.bus_type_id')
                ->leftjoin('vehicles','vehicles.id','waybills.vehicle_id')
               ->leftjoin('users','users.id','waybills.user_id')
                ->where('waybills.id',$id)
                ->orderBy('waybills.id','desc')
                ->first();
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-calculator"></span>&nbsp;Waybill Details</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <?php $exumpted = array('depot_id','user_id','shift_id','route_id','duty_id','service_id','bus_type_id','vehicle_id');
                        foreach ($res as $key=>$value) { if(!in_array($key,$exumpted)){?>     
                        <tr>        
                            <td><?=strtoupper(str_replace('_',' ',$key))?></td>
                            <td class="table_normal"><?php echo $value; ?></td>
                            <?php if($sql->flag=='u'){?>
                            <td class="table_normal"><?php echo $olddata->$key; ?></td>
                            <?php }?>
                        </tr>
                        <?php }} ?> 
                    
                    <?php $this->userHistory($res->user_name,$res->created_at,$res->updated_at) ; ?>
                   </table>  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <?php   
    }
    
    public function getData(Request $request)
    {
        try
        {
           $query = DB::table($request->table)
            ->select($request->table.'.'.$request->column.' as name',$request->table.'.id')
            ->where($request->dropdown, '=', $request->id)
            ->get(); 
          if(count($query) < 1)
          {
            $result = array('code'=>404, "description"=>"No Records Found");
            return response()->json($result, 404);
          }
          else
          {
            $result = array('data'=>$query,'code'=>200);
            return response()->json($result, 200);
          }
        
      }
      catch(Exception $e)
      {
        return response()->json(['error' => 'Something is wrong'], 500);
      }
    }
    
    public function close($id)
    {
        if(!$this->checkActionPermission('waybills','edit'))
            return redirect()->route('401');
       $waybills = DB::table('waybills')->select('*','waybills.id as id','depots.id as depot_id')
            ->leftjoin('depots','depots.id','waybills.depot_id')
            ->where('waybills.id',$id)
            ->orderBy('waybills.id','desc')
               ->first();
       $vehicles = DB::table('vehicles')
            ->where('depot_id', '=',$waybills->depot_id)
            ->orderBy('vehicle_registration_number','asc')
            ->pluck('vehicle_registration_number', 'id');
       $duties = DB::table('duties')
            ->where('route_id', '=',$waybills->route_id)
            ->orderBy('duty_number','asc')
            ->pluck('duty_number', 'id');
       $services = DB::table('services')
            ->where('bus_type_id', '=',$waybills->bus_type_id)
            ->orderBy('name','asc')
            ->pluck('name', 'id');
            //->get(); 
       //echo '<pre>';print_r($query);die;
        return view('waybills.submitform',compact('waybills','vehicles','duties','services'));
    }
    
    public function auditlist()
    {
        if(!$this->checkActionPermission('waybills','view'))
            return redirect()->route('401');
        $waybills = DB::table('waybills')
                ->select('waybills.*','waybills.id as id','depots.name as depot_name','shifts.shift','route_master.route_name',
                        'duties.duty_number','services.name as service_name','bus_types.bus_type','vehicles.vehicle_registration_number')
                ->leftjoin('depots','depots.id','waybills.depot_id')
                ->leftjoin('shifts','shifts.id','waybills.shift_id')
                ->leftjoin('route_master','route_master.id','waybills.route_id')
                ->leftjoin('duties','duties.id','waybills.duty_id')
                ->leftjoin('services','services.id','waybills.service_id')
                ->leftjoin('bus_types','bus_types.id','waybills.bus_type_id')
                ->leftjoin('vehicles','vehicles.id','waybills.vehicle_id')
                ->where('status','=','s')
                ->orderBy('waybills.id','desc')->get();
        //echo '<pre>';        print_r($waybills);die;
    return view('waybills.audit.auditlist',compact('waybills'));
   
    }
    
    public function getfiltereddata() {

        $requestData= $_REQUEST;
        $columns = array( 
                0 =>'waybills.id',
                1=>'depots.name',
                2=>'waybills.date',
                3=>'shifts.shift',
                4=>'route_master.route_name',
                5=>'waybills.status',
        );
        $sql = "SELECT waybills.*,waybills.id as id,depots.name as depot_name,shifts.shift,
                        route_master.route_name,duties.duty_number,services.name as service_name,
                        bus_types.bus_type,vehicles.vehicle_registration_number ";
        $sql.=" FROM waybills "
                . "LEFT JOIN depots on depots.id=waybills.depot_id "
                . "LEFT JOIN shifts on shifts.id=waybills.shift_id "
                . "LEFT JOIN route_master on route_master.id=waybills.route_id "
                . "LEFT JOIN duties on duties.id=waybills.duty_id "
                . "LEFT JOIN services on services.id=waybills.service_id "
                . "LEFT JOIN bus_types on bus_types.id=waybills.bus_type_id "
                . "LEFT JOIN vehicles on vehicles.id=waybills.vehicle_id "
                . "WHERE waybills.status='g'";
        //echo '<pre>';print_r($requestData);die;
        if(!empty($requestData['search']['value']) || 
                !empty($requestData['columns'][0]['search']['value']) || 
                !empty($requestData['columns'][1]['search']['value']) || 
                !empty($requestData['columns'][2]['search']['value']) || 
                !empty($requestData['columns'][3]['search']['value']) || 
                !empty($requestData['columns'][4]['search']['value']) || 
                !empty($requestData['columns'][5]['search']['value']) || 
                !empty($requestData['columns'][6]['search']['value']) ) {   
                $sql.=" AND ( ";    
        }
        if( !empty($requestData['search']['value']) ) {
                $sql.="shifts.shift LIKE '%".$requestData['search']['value']."%' and ";    
        }
        if( !empty($requestData['columns'][0]['search']['value']) ) {
                $sql.="depots.id= '".$requestData['columns'][0]['search']['value']."' and ";    
        }
        if( !empty($requestData['columns'][1]['search']['value']) ) {
                $sql.="vehicles.id= ".$requestData['columns'][1]['search']['value']." and ";    
        }
        if( !empty($requestData['columns'][2]['search']['value']) ) {
                $sql.="route_master.id= ".$requestData['columns'][2]['search']['value']." and ";    
        }
        if( !empty($requestData['columns'][3]['search']['value']) ) {
                $sql.="duties.id= ".$requestData['columns'][3]['search']['value']." and ";    
        }
        if( !empty($requestData['columns'][4]['search']['value']) ) {
                $sql.="bus_types.id= ".$requestData['columns'][4]['search']['value']." and ";    
        }
        if( !empty($requestData['columns'][5]['search']['value']) ) {
                $sql.="services.id= ".$requestData['columns'][5]['search']['value']." and ";    
        }
        if( !empty($requestData['columns'][6]['search']['value']) ) {
                $sql.="shifts.id= ".$requestData['columns'][6]['search']['value']." and ";    
        }
        
        $sql = substr($sql, 0, -4);
        if(!empty($requestData['search']['value']) || 
                !empty($requestData['columns'][0]['search']['value']) || 
                !empty($requestData['columns'][1]['search']['value']) || 
                !empty($requestData['columns'][2]['search']['value']) || 
                !empty($requestData['columns'][3]['search']['value']) || 
                !empty($requestData['columns'][4]['search']['value']) || 
                !empty($requestData['columns'][5]['search']['value']) || 
                !empty($requestData['columns'][6]['search']['value']) ) { 
                $sql.=")";
        }
        //echo $sql;die;
        $query=DB::select(DB::raw($sql) ); 
//        print_r($query);
//        die;
        $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        $totalData = count($query);
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
//        print_r($sql);
//        die;
        $query = DB::select( DB::raw($sql) ); 
        $data = array();
        foreach($query as $val){
                $id = $val->id;
                $nestedData=array(); 
                $nestedData[] = $val->id;
                $nestedData[] = $val->depot_name;
                $nestedData[] = $val->date;
                $nestedData[] = $val->shift;
                $nestedData[] = $val->route_name;
                if($val->status=="g")
                    {$nestedData[] =  'Generated';}
                elseif($val->status=="s")
                    {$nestedData[] =  'Submitted';}
                elseif($val->status=="c")
                    {$nestedData[] =  'Audited & Closed';}
                $action = '';
                if($this->checkActionPermission('waybills','edit'))
                {
                    $action = '<a  href="'.route("waybills.edit",$val->id).'" class="" title="Edit Waybill" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;'
                            . '<a  href="'.route("waybills.close",$val->id).'" class="" title="Submit Waybill" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                }
                if($this->checkActionPermission('waybills','view'))
                    $action.= '<a style="cursor: pointer;" title="View" data-toggle="modal" data-target="#'.$val->id.'"  onclick="viewDetails('.$val->id.',\'view_detail\')"><span class="glyphicon glyphicon-search"></span></a>';
                
                $nestedData[] = $action;
                $nestedData[] = ' ';
                $data[] = $nestedData;
        }
        $json_data = array(
                            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                            "recordsTotal"    => intval( $totalData ),  // total number of records
                            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                            "data"            => $data   // total data array
                            );
        echo $datajson = json_encode($json_data);  // send data as json format
    }
  }
