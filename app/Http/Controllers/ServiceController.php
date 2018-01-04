<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Service;
use App\Models\BusType;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Repositories\Service\ServiceRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    protected $services;
    public function __construct(
        ServiceRepositoryContract $services
    ) {
        $this->services = $services;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $services = DB::table('services')->select('services.id','services.name as name','services.short_name as short_name','services.id as id','bus_types.id as id','bus_types.bus_type')->leftjoin('bus_types', 'bus_types.id', '=', 'services.bus_type_id')->get();
    return view('services.index')->withServices($services);
   
    }
    public function create()
    {
     //$services = Service::findOrFail();
     return view('services.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Service $services
     * @return Response
     */
    public function store(StoreServiceRequest $servicesRequest)
    {
        $getInsertedId = $this->services->create($servicesRequest);
        return redirect()->route('services.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
  $services = DB::table('services')->select('services.id','services.name as name','services.short_name as short_name','services.id as id','bus_types.id as id','bus_types.bus_type')->leftjoin('bus_types', 'bus_types.id', '=', 'services.bus_type_id')
  ->where('services.id',$id)        
          ->first();
    return view('services.show')->withServices($services);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $services=Service::findOrFail($id);
      return view('services.edit')->withServices($services);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateServiceRequest $request)
    {
        $this->services->update($id, $request);
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
