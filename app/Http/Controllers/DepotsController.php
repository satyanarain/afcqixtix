<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Depot;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Depot\UpdateDepotRequest;
use App\Http\Requests\Depot\StoreDepotRequest;
use App\Repositories\Depot\DepotRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DepotsController extends Controller
{
    protected $depots;
    public function __construct(
        DepotRepositoryContract $depots
    ) {
        $this->depots = $depots;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $depot = DB::table('depots')->select('*')->orderBy('id','desc')->get();
    return view('depots.index')->withDepots($depot);
   
    }
    public function create()
    {
     //$depot = Depot::findOrFail();
     return view('depots.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Depot $depot
     * @return Response
     */
    public function store(StoreDepotRequest $depotRequest)
    {
        $getInsertedId = $this->depots->create($depotRequest);
        return redirect()->route('depots.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
   $depot=Depot::findOrFail($id);
    return view('depots.show')->withDepot($depot);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $depot=Depot::findOrFail($id);
      return view('depots.edit')->withDepot($depot);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateDepotRequest $request)
    {
        $this->depots->update($id, $request);
        return redirect()->route('depots.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
