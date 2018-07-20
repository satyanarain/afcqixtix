<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Stop;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stop\UpdateStopRequest;
use App\Http\Requests\Stop\StoreStopRequest;
use App\Repositories\Stop\StopRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StopController extends Controller
{
    protected $stops;
    public function __construct(
        StopRepositoryContract $stopss
    ) {
        $this->stops = $stopss;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $stops = DB::table('stops')->select('*','stops.id as id','stops.created_at as created_at','stops.updated_at as updated_at')
      ->leftjoin('users','users.id','stops.user_id')
      ->orderBy('stops.id','desc')->get();
  
    return view('stops.index')->withStops($stops);
   
    }
    public function create()
    {
     //$stops = Stop::findOrFail();
     return view('stops.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Stop $stops
     * @return Response
     */
    public function store(StoreStopRequest $stopsRequest)
    {
        $getInsertedId = $this->stops->create($stopsRequest);
        return redirect()->route('stops.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
   $stops=Stop::findOrFail($id);
    return view('stops.show')->withStops($stops);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $stops=Stop::findOrFail($id);
      return view('stops.edit')->withStops($stops);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateStopRequest $request)
    {
        $this->stops->update($id, $request);
        return redirect()->route('stops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
