<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Route;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Route\UpdateRouteRequest;
use App\Http\Requests\Route\StoreRouteRequest;
use App\Repositories\Route\RouteRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RouteController extends Controller {

    protected $routes;

    public function __construct(
    RouteRepositoryContract $routess
    ) {
        $this->routes = $routess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $routes = DB::table('routes')->select('*','routes.stop_id', 'routes.path', 'routes.route', 'routes.stop_id', 'routes.id', 'stops.stop')->leftjoin('stops', 'routes.stop_id', '=', 'stops.id')->get();
        return view('routes.index')->withRoutes($routes);
    }

    public function create() {
        //$routes = Route::findOrFail();
        return view('routes.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Route $routes
     * @return Response
     */
    public function store(StoreRouteRequest $routesRequest) {
        $getInsertedId = $this->routes->create($routesRequest);
        return redirect()->route('routes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        // $routes=Route::findOrFail($id);
        $routes = DB::table('routes')->select('*','routes.id','routes.stop_id', 'routes.path', 'routes.route', 'routes.stop_id', 'routes.id', 'stops.stop')
                ->leftjoin('stops', 'routes.stop_id', '=', 'stops.id')
                ->where('routes.id', $id)
                ->first();
       return view('routes.show')->withRoutes($routes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $routes = Route::findOrFail($id);
        return view('routes.edit')->withRoutes($routes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateRouteRequest $request) {
        $this->routes->update($id, $request);
        return redirect()->route('routes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
}
