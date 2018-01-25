<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Shift;
use App\Models\BusType;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shift\UpdateShiftRequest;
use App\Http\Requests\Shift\StoreShiftRequest;
use App\Repositories\Shift\ShiftRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class ShiftController extends Controller
{
    protected $shifts;
    public function __construct(
        ShiftRepositoryContract $shifts
    ) {
        $this->shifts = $shifts;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
     $shifts = Shift::all();
     return view('shifts.index')->withShifts($shifts);
    }
    public function create()
    {
     //$shifts = Shift::findOrFail();
     return view('shifts.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Shift $shifts
     * @return Response
     */
    public function store(StoreShiftRequest $shiftsRequest)
    {
        $getInsertedId = $this->shifts->create($shiftsRequest);
        return redirect()->route('shifts.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
   $shifts=Shift::findOrFail($id);
    return view('shifts.show')->withShifts($shifts);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $shifts=Shift::findOrFail($id);
      return view('shifts.edit')->withShifts($shifts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateShiftRequest $request)
    {
        $this->shifts->update($id, $request);
        return redirect()->route('shifts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
