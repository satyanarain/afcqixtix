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

class VehicleController extends Controller
{
    protected $vehicles;
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
    public function index()
    {
     $vehicles = DB::table('vehicles')->select('vehicles.vehicle_registration_number','vehicles.depot_id','vehicles.bus_type_id','vehicles.vehicle_registration_number','depots.id','depots.name as name','bus_types.id','bus_types.bus_type','vehicles.id as id')
            ->leftjoin('depots', 'depots.id', '=', 'vehicles.depot_id')
            ->leftjoin('bus_types', 'bus_types.id', '=', 'vehicles.bus_type_id')
            ->get();
 
    return view('vehicles.index')->withVehicles($vehicles);
   
    }
    public function create()
    {
     //$vehicles = Vehicle::findOrFail();
     return view('vehicles.create');
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
    public function store(StoreVehicleRequest $vehiclesRequest)
    {
     
        $getInsertedId = $this->vehicles->create($vehiclesRequest);
        return redirect()->route('vehicles.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
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
    public function edit($id)
    {
      
       $vehicles=Vehicle::findOrFail($id);
      return view('vehicles.edit')->withVehicles($vehicles);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateVehicleRequest $request)
    {
        $this->vehicles->update($id, $request);
        return redirect()->route('vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
