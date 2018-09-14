<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Vehicle;
use App\Models\BusType;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Http\Requests\Vehicle\StoreVehicleRequest;     
use App\Repositories\Vehicle\VehicleRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\checkPermission;
class VehicleController extends Controller
{
    protected $vehicles;
    use checkPermission;
    public function __construct(
        VehicleRepositoryContract $vehicles
    ) {
        $this->vehicles = $vehicles;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(!$this->checkActionPermission('vehicles','view'))
            return redirect()->route('401');
        $depot_id = $request->depot_id;
        $vehicles = DB::table('vehicles')->select('vehicles.vehicle_registration_number','vehicles.depot_id','vehicles.bus_type_id','vehicles.vehicle_registration_number','depots.id','depots.name as name','bus_types.id','bus_types.bus_type','vehicles.created_at as created_at','vehicles.updated_at as updated_at','vehicles.id as id','vehicles.user_id as user_id','users.user_name as user_name')
            ->leftjoin('depots', 'depots.id', '=', 'vehicles.depot_id')
            ->leftjoin('users', 'users.id', '=', 'vehicles.user_id')
            ->leftjoin('bus_types', 'bus_types.id', '=', 'vehicles.bus_type_id')
            ->where('vehicles.depot_id',$request->depot_id)  
            ->get();
        return view('vehicles.index',compact('vehicles','depot_id'));
    }
    public function create(Request $request)
    {
        if(!$this->checkActionPermission('vehicles','create'))
            return redirect()->route('401');
        $depot_id = $request->depot_id;
        //$vehicles = Vehicle::findOrFail();
        return view('vehicles.create',compact('depot_id'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Vehicle $vehicles
     * @return Response
     */
    public function store($depot_id,StoreVehicleRequest $vehiclesRequest)
    {
        if(!$this->checkActionPermission('vehicles','create'))
            return redirect()->route('401');
        //echo $depot_id;die;
        
        //$depot_id = $vehiclesRequest->depot_id;die;
        //$vehiclesRequest->depot_id = $depot_id;
        $version_id = $this->getCurrentVersion();
        $vehiclesRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
        $vehiclesRequest->request->add(['depot_id'=> $depot_id]);
        //echo '<pre>';print_r($vehiclesRequest->all());die('fdfd');
        $getInsertedId = $this->vehicles->create($vehiclesRequest);
        return redirect()->route('depots.vehicles.index',$depot_id);         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
       if(!$this->checkActionPermission('vehicles','view'))
            return redirect()->route('401');
        $vehicles = DB::table('vehicles')->select('vehicles.id','vehicles.vehicle_registration_number','vehicles.depot_id','vehicles.bus_type_id','vehicles.vehicle_registration_number','depots.id','depots.name as name','bus_types.id')
                ->leftjoin('depots', 'depots.id', '=', 'vehicles.depot_id')
                ->leftjoin('bus_types', 'bus_types.id', '=', 'vehicles.bus_type_id')
                ->where('vehicles.id',$id)        
                ->first();
  
        return view('vehicles.show')->withVehicles($vehicles);
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($depot_id,$id)
    {
        if(!$this->checkActionPermission('vehicles','edit'))
            return redirect()->route('401');
      //die($id);
       $vehicles=Vehicle::findOrFail($id);
      return view('vehicles.edit',compact('vehicles','depot_id'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($depot_id,$id, UpdateVehicleRequest $request)
    {
        if(!$this->checkActionPermission('vehicles','edit'))
            return redirect()->route('401');
         //echo $depot_id;die;
        
        //$depot_id = $vehiclesRequest->depot_id;die;
        //$vehiclesRequest->depot_id = $depot_id;
        //$request->request->add(['depot_id'=> $depot_id]);
        //echo '<pre>';print_r($request->all());die('fdfd');
         $sql=Vehicle::where([['vehicle_registration_number',$request->vehicle_registration_number],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Vehicle registration number has already been taken.']);
      } else {
        $request->request->add(['approval_status'=>'p','flag'=> 'u']);
        $this->vehicles->update($id, $request);
        return redirect()->route('depots.vehicles.index',$depot_id);   
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
