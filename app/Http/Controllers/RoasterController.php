<?php

namespace App\Http\Controllers;


use DB;
use Gate;
use Carbon;
use Schema;
use Response;
use Notifynder;
use DateTime;
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
        return view('roasters.index');
   
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
                ->select('id','crew_name','crew_id','role')
                ->where('crew.depot_id',$depot_id)
                ->where('crew.crew_type','Permanent')
                ->orderBy('crew_name','asc')
                ->get();
        //echo '<pre>';        print_r($crews);die;
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
       //die('dsf');
        $roasters = DB::table('roasters')->select('*','roasters.id as id','depots.id as depot_id','shifts.shift as shift')
            ->leftjoin('depots','depots.id','roasters.depot_id')
            ->leftjoin('shifts','shifts.id','roasters.shift_id')
            ->where('roasters.id',$id)
            ->orderBy('roasters.id','desc')
               ->first();
        $shifts = DB::table('shifts')
                ->select('shifts.*')
                ->orderBy('order_number','asc')
                ->get();
        
        $shift_crews = DB::table('roaster_on_duty')
                ->select('roaster_on_duty.crew_id','crew.crew_name','crew.role','crew.crew_id as crewid')
                ->leftjoin('crew','roaster_on_duty.crew_id','crew.id')
                ->where('roaster_on_duty.roaster_id',$id)
                //->list('crew_id','crew_id');
                ->get();
            //->get(); 
        $crew_on_duty = array();
        foreach($shift_crews as $key=>$row)
        {
            $crew_on_duty[$key]['crew_id'] = $row->crew_id;
            $crew_on_duty[$key]['crew_name'] = $row->crew_name;
            $crew_on_duty[$key]['role'] = $row->role;
            $crew_on_duty[$key]['crewid'] = $row->crewid;
        }    
        //echo '<pre>';        print_r($crew_on_duty);die;
        return view('roasters.show',compact('roasters','shifts','crew_on_duty'));
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
       $roasters = DB::table('roasters')->select('*','roasters.id as id','depots.id as depot_id','shifts.shift as shift')
            ->leftjoin('depots','depots.id','roasters.depot_id')
            ->leftjoin('shifts','shifts.id','roasters.shift_id')
            ->where('roasters.id',$id)
            ->orderBy('roasters.id','desc')
               ->first();
        $shifts = DB::table('shifts')
                ->select('shifts.*')
                ->orderBy('order_number','asc')
                ->get();
        $crews = DB::table('crew')
                ->select('id','crew_name','crew_id','role')
                ->where('crew.depot_id',$roasters->depot_id)
                ->where('crew.crew_type','Permanent')
                ->orderBy('crew_name','asc')
                ->get();
        $shift_crews = DB::table('roaster_on_duty')
                ->select('crew_id')
                ->where('roaster_id',$id)
                //->list('crew_id','crew_id');
                ->get();
            //->get(); 
        $crew_on_duty = array();
        foreach($shift_crews as $row)
            $crew_on_duty[] = $row->crew_id;
        
//        $shift_crews_off = DB::table('roaster_off_duty')
//                ->select('crew_id')
//                ->where('roaster_id',$id)
//                //->list('crew_id','crew_id');
//                ->get();
            //->get(); 
//        $crew_off_duty = array();
//        foreach($shift_crews_off as $row)
//            $crew_off_duty[] = $row->crew_id;
        //echo '<pre>';print_r($crew_on_duty);die;
        return view('roasters.edit',compact('roasters','shifts','crews','crew_on_duty'));
    }

    /**
     * Display the specified resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    public function update($id, UpdateRoasterRequest $request)
    {
        if(!$this->checkActionPermission('roasters','edit'))
            return redirect()->route('401');
        //echo '<pre>';print_r($request->all());die;
        $this->roasters->update($id, $request);
        return redirect()->route('roasters.index');
    }

   /**
     * Display the filtered resource.
     *
     * @created by satya  
     * @date 20-02-2018
     */
    public function getfiltereddata(Request $requestData) {
        if(!$this->checkActionPermission('roasters','view'))
            return redirect()->route('401');
        $sql = "SELECT roasters.*,roasters.id as id,depots.name as depot_name,shifts.shift";
        $sql.=" FROM roasters "
                . "LEFT JOIN depots on depots.id=roasters.depot_id "
                . "LEFT JOIN shifts on shifts.id=roasters.shift_id "
                ;
        //echo '<pre>';print_r($requestData);die;
        if(!empty($requestData['depot_id']) || 
                !empty($requestData['from_date']) || 
                !empty($requestData['to_date']) || 
                !empty($requestData['shift_id']) ) {   
                $sql.=" where ";    
        }
        if( !empty($requestData['depot_id']) ) {
                $sql.="roasters.depot_id = '".$requestData['depot_id']."' and ";    
        }
        if( !empty($requestData['shift_id']) ) {
                $sql.="roasters.shift_id= '".$requestData['shift_id']."' and ";    
        }
        if(!empty($requestData['from_date']) && !empty($requestData['to_date']) ) {
                $sql.="(roasters.dated_on between '".date('Y-m-d',strtotime($requestData['from_date']))."' and '".date('Y-m-d',strtotime($requestData['to_date']))."') and ";    
        }elseif(!empty($requestData['from_date']) && empty($requestData['to_date']) ) {
                $sql.="roasters.dated_on>= ".date('Y-m-d',strtotime($requestData['from_date']))." and ";    
        }elseif(empty($requestData['from_date']) && !empty($requestData['to_date']) ) {
                $sql.="roasters.dated_on<= ".date('Y-m-d',strtotime($requestData['to_date']))." and ";    
        }
        $sql = substr($sql, 0, -4);
        //$sql .= " order by roasters.id desc";
        $roasters=DB::select(DB::raw($sql) ); 
       // echo '<pre>';        print_r($roasters);die;
        return view('roasters.getfiltereddata',compact('roasters'));
    }
   
    public function addroasterform() {
        return view('roasters.addroasterform');
    }
    
    /**
     * Copy Roaster.
     *
     * @created by kunal  
     * @date 22-02-2019
     */
    public function copyroasterform() {
        return view('roasters.copyroasterform');
    }
    
    public function generateCopy(Request $request)
    {
        if(!$this->checkActionPermission('roasters','create'))
            return redirect()->route('401');
        
        $depot_id = $request['depot_id'];
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $effect_from = $request['effect_from'];
        $startTime = strtotime($from_date);
        $endTime = strtotime($to_date);
        $effectFromTime = strtotime($effect_from);
        
        $datetime1 = new DateTime($from_date);
        $datetime2 = new DateTime($to_date);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a')+1;


        
        $roasters = DB::table('roasters')
                ->select('roasters.*','shifts.shift as shift_name')
                ->leftjoin('shifts','shifts.id','roasters.shift_id')
                ->whereBetween('dated_on',array(date("Y-m-d",$startTime),date("Y-m-d",$endTime)))
                ->where('depot_id',$depot_id)
                ->orderBy('dated_on','asc')->get();
        //echo '<pre>';
        //print_r($roasters);
        $data = array();
        foreach($roasters as $roaster){
            $data[$roaster->dated_on]['copied_to'] = date("Y-m-d",strtotime($request['effect_from']));
            $data[$roaster->dated_on]['on-duty'][$roaster->shift_id]['shift_name'] = $roaster->shift_name;
            $crew_on_duty = DB::table('roaster_on_duty')
                    ->select('crew_id')
                    ->where('roaster_id',$roaster->id)
                    ->get();
            foreach($crew_on_duty as $crew_duty)
                $data[$roaster->dated_on]['on-duty'][$roaster->shift_id]['crew_on_duty'][] = $crew_duty->crew_id;
        }
        $crew_off_duty = DB::table('roaster_off_duty')
                    ->select('crew_id','dated_on')
                    ->whereBetween('dated_on',array(date("Y-m-d",$startTime),date("Y-m-d",$endTime)))
                    ->where('depot_id',$depot_id)
                    ->get();
        foreach($crew_off_duty as $crew_duty)
                $data[$crew_duty->dated_on]['off-duty'][] = $crew_duty->crew_id;
//        echo '<pre>';
//        print_r($data);
//        print_r($request->all());die;
        $shifts = DB::table('shifts')
                ->select('shifts.*')
                ->orderBy('order_number','asc')
                ->get();
        $crews = DB::table('crew')
                ->select('id','crew_name','crew_id','role')
                ->where('crew.depot_id',$depot_id)
                ->where('crew.crew_type','Permanent')
                ->orderBy('crew_name','asc')
                ->get();
        //echo '<pre>';        print_r($crews);die;
        //echo $days;die;
        return view('roasters.copyroaster', compact('effectFromTime','startTime','endTime','depot_id','shifts','crews','effect_from','data','days'));
    }
    
    public function storecopy(StoreRoasterRequest $roasters)
    {
        if(!$this->checkActionPermission('roasters','create'))
            return redirect()->route('401');
        //echo '<pre>';print_r($roasters->all());die;
        $getInsertedId = $this->roasters->create($roasters);
        return redirect()->route('roasters.index');         
    }
  }
