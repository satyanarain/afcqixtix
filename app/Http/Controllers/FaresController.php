<?php

namespace App\Http\Controllers;

use App\Models\Fare;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Repositories\Fare\FareRepositoryContract;

class FaresController extends Controller
{
    private $fares;

    public function __construct(FareRepositoryContract $fares)
    {
        $this->fares = $fares; 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::pluck('name', 'id');
        return view('fares.index')
            ->withServices($services);
    }

    public function anyData(Request $request)
    {
        $service = $request->service;
        $numberOfUnits = $request->number_of_units;

        $fares = Fare::where([['service_id', '=', $service], ['number_of_units', '=', $numberOfUnits]])->get();

        return response()->json($fares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::pluck('name', 'id');
        return view('fares.create')
            ->withServices($services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->fares->create($request);

        return redirect()->route('fares.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
