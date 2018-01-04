<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Target;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Target\UpdateTargetRequest;
use App\Http\Requests\Target\StoreTargetRequest;
use App\Repositories\Target\TargetRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TargetController extends Controller {

    protected $duties;

    public function __construct(
    TargetRepositoryContract $duties
    ) {
        $this->duties = $duties;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $duties = DB::table('duties')->select('*','duties.id as id')
                ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'duties.route_id', '=', 'routes.id')
                ->get();
        return view('duties.index')->withDuties($duties);
    }

    public function create() {
        //$duties = Target::findOrFail();
        return view('duties.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Target $duties
     * @return Response
     */
    public function store(StoreTargetRequest $dutiesRequest) {
        $getInsertedId = $this->duties->create($dutiesRequest);
        return redirect()->route('duties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        // $duties=Target::findOrFail($id);
         $duties = DB::table('duties')->select('*','duties.id as id')
                ->leftjoin('shifts', 'duties.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'duties.route_id', '=', 'routes.id')
                 ->where('duties.id','=',$id)
                ->first();
        
       return view('duties.show')->withDuties($duties);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $duties = Target::findOrFail($id);
        return view('duties.edit')->withDuties($duties);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateTargetRequest $request) {
        $this->duties->update($id, $request);
        return redirect()->route('duties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
}
