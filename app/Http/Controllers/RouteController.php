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

        $routes = DB::table('routes')->select('*','route_details.stop_id','routes.route', 'routes.id', 'stops.stop')
                ->leftjoin('route_details', 'route_details.stop_id', '=', 'routes.id')
                ->leftjoin('stops', 'route_details.stop_id', '=', 'stops.id')
                ->get();
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
        $routesRequest->route;
        
//      $sql=  Route::where([['route',$routesRequest->route],['direction',$routesRequest->direction]]);
//        if(count($sql)>0)
//        {
//            return redirect()->back()->withErrors(['This route and direction has already been taken.']);
//        } else {
         $getInsertedId = $this->routes->create($routesRequest);
        return redirect()->route('routes.index');
       // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    
          public function viewDetail($id) {
           $routes=Route::find($id);
            $sql = DB::table('route_details')->where('route_id',$id)
             ->get();
               
        ?>
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header-view" >
                    <!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                    <h4 class="viewdetails_details"><span class="fa fa-map-marker"></span>&nbsp;Route</h4>
                </div>
                <div class="modal-body-view">
                    <table class="table table-responsive.view">
                        <tr>       
                            <td colspan="2"><b>Route</b></td>
                            <td class="table_normal"><?php echo $routes->route; ?></span></td>
                        </tr>
                        <tr>       
                            <td colspan="4"><div class="path-section">
                                    <p class="path-section-heading">Path</p>

                                    <div class="path-section-content">
                                        <table class="table table-responsive.view">
                                            <tr>       
                                                <td colspan="2"><b>Source</b></td>
                                                <td class="table_normal"><?php displayIdBaseName('stops', $routes->source, 'stop'); ?></span></td>
                                            </tr>
                                            <tr>       
                                                <td colspan="2"><b>Destination</b></td>
                                                <td class="table_normal"><?php displayIdBaseName('stops', $routes->destination, 'stop'); ?></span></td>
                                            </tr>

                                            <tr>       
                                                <td colspan="2"><b>Via</b></td>
                                                <td class="table_normal"><?php displayIdBaseName('stops', $routes->via, 'stop'); ?></span></td>
                                            </tr>
                                            <tr>       
                                                <td colspan="2"><b>Default Path</b></td>
                                                <td class="table_normal"><?php displayView($routes->default_path); ?></span></td>
                                            </tr>  
                                        </table>

                                    </div>
                                </div></td>
                        </tr>
                        <tr>       
                            <td colspan="4"><div class="path-section">
                                    <p class="path-section-heading">Stop Details</p>

                                    <div class="path-section-content">
                                        <table class="table table-responsive.view">

                                            <tr>        <td>Stop</td>
                                                <td>Stage Number</td>
                                                <td>Distance(km)</td>
                                                <td>Hot Key</td>

                                            </tr>
                                            <?php foreach ($sql as $value) { ?>   
                                                <tr><td class="table_normal"><?php echo $value->stop_id; ?></td>
                                                    <td class="table_normal"><?php echo $value->stage_number; ?></td>
                                                    <td class="table_normal"><?php echo $value->distance; ?></td>
                                                    <td class="table_normal"><?php echo $value->hot_key; ?></td>
                                                </tr>
                                            <?php } ?> 
                                        </table>

                                    </div>
                                </div></td>
                        </tr>
                          <tr>       
                            <td colspan="2"><b>Is this via stop of the path</b></td>
                            <td class="table_normal"><?php displayView($routes->is_this_by); ?></span></td>
                        </tr>            
                    </table>  

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    <?php   
    }
    
    
    
    
    public function show($id) {
 $routes = DB::table('routes')->select('*','route_details.stop_id','routes.route', 'routes.id', 'stops.stop')
                ->leftjoin('route_details', 'route_details.stop_id', '=', 'routes.id')
                ->leftjoin('stops', 'route_details.stop_id', '=', 'stops.id')
                ->get();
        return view('routes.index')->withRoutes($routes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $routes = Route::findOrFail($id);
         $route_details = DB::table('route_details')->select('*')->where('route_id', $id)->get();
        return view('routes.edit',compact('routes','route_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateRouteRequest $request) {
      $sql = Route::where([['route', $request->route], ['direction', $request->direction], ['id', '!=', $id]])->first();
        if (count($sql) > 0) {
            return redirect()->back()->withErrors(['This route and direction has already been taken.']);
        } else {
            $this->routes->update($id, $request);
            return redirect()->route('routes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
}
