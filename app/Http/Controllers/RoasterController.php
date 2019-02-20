<?php

namespace App\Http\Controllers;


use DB;
use Gate;
use Carbon;
use Schema;
use Response;
use Notifynder;
use App\Models\Roaster;
use App\Models\RoasterOnDuty;
use App\Models\RoasterOffDuty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Roaster\UpdateRoasterRequest;
use App\Http\Requests\Roaster\StoreRoasterRequest;
use App\Repositories\Roaster\RoasterRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\activityLog;
use App\Traits\Ac;
use App\Traits\checkPermission;
//use Illuminate\Support\Facades\Validator;
class RoasterController extends Controller
{
    protected $roasters;
 
    use activityLog;
    use checkPermission;
    public function __construct(
        RoasterRepositoryContract $roasters
    ) {
        $this->roasters = $roasters;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('roasters','view'))
            return redirect()->route('401');
        $roasters = DB::table('roasters')
                ->select('roasters.*','roasters.id as id','depots.name as depot_name','shifts.shift')
                ->leftjoin('depots','depots.id','roasters.depot_id')
                ->leftjoin('shifts','shifts.id','roasters.shift_id')
                ->orderBy('roasters.id','desc')->count();
        $roasters = Roaster::with(['onDuty.crew:id,crew_name','depot:id,name','shift:id,shift','createdBy:id,name'])->get();
        
        //echo '<pre>';        print_r($roasters);die;
        return view('roasters.index',compact('roasters'));
   
    }
    
    /**
     * Display a listing of the roaster 
     *
     * @return Response
     */
    public function filteredlist()
    {
        if(!$this->checkActionPermission('roasters','view'))
            return redirect()->route('401');
        $roasters = DB::table('roasters')
                ->select('roasters.*','roasters.id as id','depots.name as depot_name','shifts.shift')
                ->leftjoin('depots','depots.id','roasters.depot_id')
                ->leftjoin('shifts','shifts.id','roasters.shift_id')
                ->orderBy('roasters.id','desc')->count();
        $roasters = Roaster::with(['onDuty.crew:id,crew_name','depot:id,name','shift:id,shift','createdBy:id,name'])->get();
        
        //echo '<pre>';        print_r($roasters);die;
        return view('roasters.index',compact('roasters'));
   
    }
    
    public function create(Request $request)
    {
        if(!$this->checkActionPermission('roasters','create'))
            return redirect()->route('401');
        $depot_id = $request->depot_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $startTime = strtotime($from_date);
        $endTime = strtotime($to_date);
        
        $shifts = DB::table('shifts')
                ->select('shifts.*')
                ->orderBy('order_number','asc')
                ->get();
        $crews = DB::table('crew')
                ->select('id','crew_name')
                ->where('crew.depot_id',$depot_id)
                ->orderBy('crew_name','asc')
                ->get();
        
        return view('roasters.create', compact('startTime','endTime','depot_id','shifts','crews'));
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
    public function store(StoreRoasterRequest $roasters)
    {
        if(!$this->checkActionPermission('roasters','create'))
            return redirect()->route('401');
        //echo '<pre>';print_r($roasters->all());die;
        $getInsertedId = $this->roasters->create($roasters);
        return redirect()->route('roasters.index');         
    }
    /**
     * Display the specified resource.
     *
     * @create by satya  int  $id
     * @date 20-02-2018
     */
   public function show($id)
   {
       if(!$this->checkActionPermission('roasters','view'))
            return redirect()->route('401');
       
        $roasters = Roaster::with(['onDuty.crew:id,crew_name', 'offDuty.crew:id,crew_name','depot:id,name','shift:id,shift','createdBy:id,name'])
                ->where('roasters_id',$id)
                ->first();
        return view('roasters.index',compact('roasters'))->withWaybills($depot);
   
     }

    /**
     * Display the specified resource.
     *
     * @created by satya 
     * @date 20-02-2018
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('roasters','edit'))
            return redirect()->route('401');
       $roasters = DB::table('roasters')->select('*','roasters.id as id','depots.id as depot_id')
            ->leftjoin('depots','depots.id','roasters.depot_id')
            ->where('roasters.id',$id)
            ->orderBy('roasters.id','desc')
               ->first();
       $vehicles = DB::table('vehicles')
            ->where('depot_id', '=',$roasters->depot_id)
            ->orderBy('vehicle_registration_number','asc')
            ->pluck('vehicle_registration_number', 'id');
       $duties = DB::table('duties')
            ->where('route_id', '=',$roasters->route_id)
            ->orderBy('duty_number','asc')
            ->pluck('duty_number', 'id');
       $services = DB::table('services')
            ->where('bus_type_id', '=',$roasters->bus_type_id)
            ->orderBy('name','asc')
            ->pluck('name', 'id');
            //->get(); 
       //echo '<pre>';print_r($query);die;
        return view('roasters.edit',compact('roasters','vehicles','duties','services'));
    }

    /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    public function update($id, UpdateWaybillRequest $request)
    {
        if(!$this->checkActionPermission('roasters','edit'))
            return redirect()->route('401');
        $this->roasters->update($id, $request);
        return redirect()->route('roasters.index');
    }

   /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    
    public function viewDetail($id) {
          if(!$this->checkActionPermission('roasters','view'))
            return redirect()->route('401');
       $res = DB::table('roasters')
                ->select('users.user_name','roasters.id as id','depots.name as depot_name','shifts.shift','route_master.route_name',
                        'duties.duty_number','services.name as service_name','bus_types.bus_type','vehicles.vehicle_registration_number','roasters.*','crew1.crew_name as driver','crew2.crew_name as conductor')
                ->leftjoin('depots','depots.id','roasters.depot_id')
                ->leftjoin('shifts','shifts.id','roasters.shift_id')
                ->leftjoin('route_master','route_master.id','roasters.route_id')
                ->leftjoin('duties','duties.id','roasters.duty_id')
                ->leftjoin('services','services.id','roasters.service_id')
                ->leftjoin('bus_types','bus_types.id','roasters.bus_type_id')
                ->leftjoin('vehicles','vehicles.id','roasters.vehicle_id')
                ->leftjoin('users','users.id','roasters.user_id')
                ->leftjoin('crew as crew1','crew1.id','roasters.driver_id')
                ->leftjoin('crew as crew2','crew2.id','roasters.conductor_id')
                ->where('roasters.id',$id)
                ->orderBy('roasters.id','desc')
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
              ->where($request->dropdown, '=', $request->id);
            if($request->ele == 'conductor_id')
            {
              $query = $query->where('role', 'Conductor');
            }else if($request->ele == 'driver_id'){
              $query = $query->where('role', 'Driver');
            }else{
              $query = $query;
            }
            
            $query = $query->get(); 
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
    
    public function auditdetail($id)
    {
        if(!$this->checkActionPermission('roasters','edit'))
            return redirect()->route('401');
        $roasters = DB::table('roasters')->select('*','roasters.id as id','depots.id as depot_id')
                    ->leftjoin('depots','depots.id','roasters.depot_id')
                    ->where('roasters.id',$id)
                    ->orderBy('roasters.id','desc')
                    ->first();
       $vehicles = DB::table('vehicles')
            ->where('depot_id', '=',$roasters->depot_id)
            ->orderBy('vehicle_registration_number','asc')
            ->pluck('vehicle_registration_number', 'id');
       $duties = DB::table('duties')
            ->where('route_id', '=',$roasters->route_id)
            ->orderBy('duty_number','asc')
            ->pluck('duty_number', 'id');
       $services = DB::table('services')
            ->where('bus_type_id', '=',$roasters->bus_type_id)
            ->orderBy('name','asc')
            ->pluck('name', 'id');
       $amount_payable = DB::table('tickets')
                    ->where('abstract_id','=',$roasters->abstract_no)
                    ->sum('total_amt');
        $crew = DB::table('crew')
            ->where('depot_id', '=',$roasters->depot_id)
            ->orderBy('crew_name','asc')
            ->pluck('crew_name', 'id');
            //->get(); 
       //echo '<pre>';print_r($duties);die;
        $etm_ticket_amount = DB::table('tickets')
                    ->where('abstract_id','=',$roasters->abstract_no)
                    ->where('ticket_type','=','Ticket')
                    ->sum('total_amt');
        $etm_pass_amount = DB::table('tickets')
                    ->where('abstract_id','=',$roasters->abstract_no)
                    ->where('ticket_type','=','ETMPass')
                    ->sum('total_amt');
        $epurse_amount = DB::table('tickets')
                    ->where('abstract_id','=',$roasters->abstract_no)
                    ->where('ticket_type','=','EPurse')
                    ->sum('total_amt');
        $pass_amount = DB::table('tickets')
                    ->where('abstract_id','=',$roasters->abstract_no)
                    ->where('ticket_type','=','Pass')
                    ->sum('total_amt');
        $items = DB::table('inv_crew_stock')
                    ->select('*','inv_crew_stock.id as stock_id','inv_crew_stock.id as id','denominations.description as denom','denominations.id as denomination_id')
                    ->leftjoin('inv_items_master','inv_items_master.id','inv_crew_stock.items_id')
                    ->leftjoin('denominations','denominations.id','inv_crew_stock.denom_id')
                    //->leftjoin('inv_items_master','inv_items_master.id','inv_crew_stock.items_id')
                    ->where('inv_crew_stock.crew_id',$roasters->conductor_id)
                    ->orderBy('inv_crew_stock.end_sequence','desc')
                    ->get();
        foreach($items as $key=>$item){
            $items_audited = DB::table('audit_inventory')
                    ->select('audit_inventory.*','inv_items_master.*','denominations.id as denomination_id')
                    ->leftjoin('inv_crew_stock','inv_crew_stock.id','audit_inventory.inv_crew_stock_id')
                    ->leftjoin('inv_items_master','inv_items_master.id','inv_crew_stock.items_id')
                    ->leftjoin('denominations','denominations.id','audit_inventory.denom_id')
                    ->where('audit_inventory.inv_crew_stock_id',$item->id)
                    ->where('audit_inventory.denom_id',$item->denom_id)
                    ->orderBy('audit_inventory.id','desc')
                    ->first();
                   
            if(count($items_audited)){
                $items[$key]->start_sequence = $items_audited->start_sequence;
            }
            //echo '<pre>';print_r($items_audited);
        }
        //echo '<pre>';print_r($items);die;
        $total_payout = DB::table('payouts')
                    ->where('abstract_no','=',$roasters->abstract_no)
                    ->sum('amount');
        $shift_details = DB::table('shift_start')
                    ->select('shift_start.*','crew.crew_name as conductor_name','crew1.crew_name as driver_name',
                            'vehicles.vehicle_registration_number','bus_types.bus_type','routes.route','duties.duty_number','shifts.shift')
                    ->leftjoin('crew','crew.id','shift_start.conductor_id')
                    ->leftjoin('crew as crew1','crew1.id','shift_start.driver_id')
                    ->leftjoin('routes','routes.id','shift_start.route_id')
                    ->leftjoin('duties','duties.id','shift_start.duty_id')
                    ->leftjoin('shifts','shifts.id','shift_start.shift_id')
                    ->leftjoin('vehicles','vehicles.id','shift_start.vehicle_id')
                    ->leftjoin('bus_types','vehicles.bus_type_id','bus_types.id')
                    ->where('shift_start.abstract_no',$roasters->abstract_no)
                    ->first();
        //echo '<pre>';print_r($items);die;
        return view('roasters.submitform',compact('roasters','vehicles','duties','services','crew','etm_ticket_amount','etm_pass_amount','epurse_amount','pass_amount','items','total_payout','shift_details'));
    }
    
    public function saveaudit()
    {
        //echo '<pre>';print_r($_POST);die;
        $query = DB::table('roasters')
                    ->where('id', '=', $_POST['waybill_id'])
                    ->update(['new_driver_id' => $_POST['new_driver_id'],'new_conductor_id' => $_POST['new_conductor_id'],
                        'etm_no' => $_POST['etm_no'],'vehicle_id' => $_POST['vehicle_id'],
                        'bag_no' => $_POST['bag_no'],'waybill_no' => $_POST['waybill_no'],'portable_ups_issued' => $_POST['portable_ups_issued'],
                        'portable_ups_received' => $_POST['portable_ups_received'],'remarks' => $_POST['remarks']]);
        $audited_by = Auth::id();
        foreach($_POST['itemstock'] as $stock_id=>$quantity)
        {
            if($quantity)
            {
                $stock_item_detail = DB::table('inv_crew_stock')
                    ->leftjoin('denominations','denominations.id','inv_crew_stock.denom_id')
                    ->select('inv_crew_stock.*','denominations.price')
                    ->where('inv_crew_stock.id',$stock_id)
                    ->first();
                $updated_quantity = $quantity-$stock_item_detail->start_sequence;
                $sold_ticket_value = $updated_quantity*$stock_item_detail->price;
                
                //echo '<pre>';print_r($stock_item_detail);die;
                $query = DB::table('audit_inventory')
                    ->insertGetId(['audited_by'=>$audited_by,'inv_crew_stock_id'=>$stock_item_detail->id,'waybill_number'=>$_POST['abstract_no'],
                    'depot_id'=>$stock_item_detail->depot_id,'crew_id'=>$stock_item_detail->crew_id,'denom_id'=>$stock_item_detail->denom_id,
                    'series'=>$stock_item_detail->series,'start_sequence'=>$quantity,
                    'end_sequence'=>$stock_item_detail->end_sequence,'sold_ticket_value'=>$sold_ticket_value,'quantity'=>$quantity]);
            }
        }
        //echo '<pre>';print_r($_POST);die;

        //echo '<pre>';print_r($stock_item_detail);die;
        $query = DB::table('audit_remittance')
                    ->insertGetId(['audited_by'=>$audited_by,'depot_id'=>$_POST['depot_id'],'waybill_number'=>$_POST['abstract_no'],
                    'total_cash'=>$_POST['total_cash_value'],'total_payout'=>$_POST['total_payout_value'],'batta'=>$_POST['batta'],
                    'driver_incentive'=>$_POST['driver_incentive'],'conductor_incentive'=>$_POST['conductor_incentive'],
                    'tea_allowance'=>$_POST['tea_allowance'],'remarks'=>$_POST['remarks'],'payable_amount'=>$_POST['payable_amount_value']]);
            
        $query = DB::table('roasters')
                    ->where('abstract_no', '=', $_POST['abstract_no'])
                    ->update(['status' => 'c']);
        return redirect()->route('roasters.index');
    }

    public function close()
    {
        if(!$this->checkActionPermission('roasters','view'))
            return redirect()->route('401');
        $roasters = DB::table('roasters')
                ->select('roasters.*','roasters.id as id','depots.name as depot_name','shifts.shift','route_master.route_name',
                        'duties.duty_number','services.name as service_name','bus_types.bus_type','vehicles.vehicle_registration_number')
                ->leftjoin('depots','depots.id','roasters.depot_id')
                ->leftjoin('shifts','shifts.id','roasters.shift_id')
                ->leftjoin('route_master','route_master.id','roasters.route_id')
                ->leftjoin('duties','duties.id','roasters.duty_id')
                ->leftjoin('services','services.id','roasters.service_id')
                ->leftjoin('bus_types','bus_types.id','roasters.bus_type_id')
                ->leftjoin('vehicles','vehicles.id','roasters.vehicle_id')
                ->where('status','=','s')
                ->orderBy('roasters.id','desc')->get();
        //echo '<pre>';        print_r($roasters);die;
        return view('roasters.audit.auditlist',compact('roasters'));
   
    }
    
    public function getfiltereddata() {

        $requestData= $_REQUEST;
        $columns = array( 
                0 =>'roasters.id',
                1=>'depots.name',
                2=>'roasters.date',
                3=>'shifts.shift',
                4=>'route_master.route_name',
                5=>'roasters.status',
        );
        $sql = "SELECT roasters.*,roasters.id as id,depots.name as depot_name,shifts.shift,
                        route_master.route_name,duties.duty_number,services.name as service_name,
                        bus_types.bus_type,vehicles.vehicle_registration_number ";
        $sql.=" FROM roasters "
                . "LEFT JOIN depots on depots.id=roasters.depot_id "
                . "LEFT JOIN shifts on shifts.id=roasters.shift_id "
                ;
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
                if($this->checkActionPermission('roasters','edit'))
                {
                    $action = '<a  href="'.route("roasters.edit",$val->id).'" class="" title="Edit Waybill" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                }
                if($this->checkActionPermission('roasters','view'))
                    $action.= '<a style="cursor: pointer;" title="View" data-toggle="modal" data-target="#'.$val->id.'"  onclick="viewDetails('.$val->id.',\'view_detail\')"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                
                if($this->checkActionPermission('audits','create') && $val->status=="s")
                {
                    $action.='<a  href="'.route("roasters.auditdetail",$val->id).'" class="" title="Audit Waybill" ><span class="fa fa-briefcase"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                }
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
    
    public function cash_collection(){
        if(!$this->checkActionPermission('cash_collections','edit'))
            return redirect()->route('401');
        return view('roasters.cash_collection.create',compact('roasters'));
    }
    
    public function storecash(Request $request){
        if(!$this->checkActionPermission('cash_collections','edit'))
            return redirect()->route('401');
        $collected_by = Auth::id();
        //echo '<pre>';print_r($request->all());die;
        if ($request->input('cash_remitted')){
            $query = DB::table('cash_collection')
                    ->insertGetId(['collected_by'=>$collected_by,'abstract_no'=>$request['abstract_no'],'amount_payable'=>$request['amount_payable'],'cash_remitted'=>$request['cash_remitted'],'cash_challan_no'=>$request['cash_challan_no']]);
        
            $query = DB::table('roasters')
            ->where('abstract_no', '=', $request['abstract_no'])
            ->update(['status' => 's']);
        }
        return view('roasters.cash_collection.create');
    }
    
    public function getabstractdetail(){
        if(!$this->checkActionPermission('roasters','view'))
            return redirect()->route('401');
        $requestData= $_REQUEST;
        //print_r($requestData);die;
        $cash_exist = DB::table('cash_collection')
            ->select('*')
            ->where('abstract_no','=',$requestData['abstract_no'])
            ->first();
        if($cash_exist)
        {
            $json_data = array(
                                "status"            =>  'error',
                                "message"               => 'Cash is already sbumitted for this abstract number.'
                                );
        }else{
            $roasters = DB::table('shift_start')
                ->select('*')
                ->leftjoin('crew','shift_start.conductor_id','crew.id')
                ->leftjoin('duties','shift_start.duty_id','duties.id')
                ->where('abstract_no','=',$requestData['abstract_no'])
                ->first();
            if($roasters){
                $amount_payable = DB::table('tickets')
                    ->where('abstract_id','=',$requestData['abstract_no'])
                    ->sum('total_amt');
                //echo '<pre>';        print_r($amount_payable);die;
                $json_data = array(
                                "conductor_name"          =>  $roasters->crew_name,  
                                "conductor_id"            =>  $roasters->crew_id,
                                "amount_payable"          =>  $amount_payable,
                                "route_id"                =>  $roasters->route_id,
                                "duty_id"                 =>  $roasters->duty_id,
                                "status"                  =>  'success',
                                "message"                 => ''
                                );
                
            }else{
                $json_data = array(
                                "status"            =>  'error',
                                "message"               => 'Invalid abstract number.'
                                );
            }
        }
        //echo '<pre>';        print_r($roasters);die;
        echo $datajson = json_encode($json_data);  // send data as json format
    }
    
    public function addroasterform() {
        return view('roasters.addroasterform');
    }
  }
