<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\BusType;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusType\UpdateBusTypeRequest;
use App\Http\Requests\BusType\StoreBusTypeRequest;
use App\Repositories\BusType\BusTypeRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BusTypesController extends Controller
{
    protected $bustypes;
    public function __construct(
        BusTypeRepositoryContract $bustypes
    ) {
        $this->bustypes = $bustypes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
    $bustypes = BusType::orderBy('id')->get();
    return view('bustypes.index')->withBustypes($bustypes);
   
    }
    public function create()
    {
     return view('bustypes.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Bustype $bustypes
     * @return Response
     */
    public function store(StoreBusTypeRequest $bustypesRequest)
    {
        $getInsertedId = $this->bustypes->create($bustypesRequest);
        return redirect()->route('bus_types.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
   $bustypes=Bustype::findOrFail($id);
    return view('bustypes.show')->withBustypes($bustypes);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $bustypes=Bustype::findOrFail($id);
       return view('bustypes.edit')->withBustypes($bustypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateBusTypeRequest $request)
    {
        $this->bustypes->update($id, $request);
        return redirect()->route('bus_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
