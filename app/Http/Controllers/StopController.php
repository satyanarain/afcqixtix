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
use App\Traits\checkPermission;
class StopController extends Controller
{
    use checkPermission;
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
        if(!$this->checkActionPermission('stops','view'))
            return redirect()->route('401');
    $stops = DB::table('stops')->select('*','stops.id as id','stops.created_at as created_at','stops.updated_at as updated_at')
      ->leftjoin('users','users.id','stops.user_id')
      ->orderBy('stops.id','desc')->get();
  
    return view('stops.index')->withStops($stops);
   
    }
    public function create()
    {
        if(!$this->checkActionPermission('stops','create'))
            return redirect()->route('401');
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
        if(!$this->checkActionPermission('stops','create'))
            return redirect()->route('401');
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
       if(!$this->checkActionPermission('stops','view'))
            return redirect()->route('401');
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
        if(!$this->checkActionPermission('stops','edit'))
            return redirect()->route('401');
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
        if(!$this->checkActionPermission('stops','edit'))
            return redirect()->route('401');
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
