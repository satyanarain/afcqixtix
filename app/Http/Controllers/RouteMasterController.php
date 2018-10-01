<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\RouteMaster;
use App\Models\Route;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RouteMaster\UpdateRouteMasterRequest;
use App\Http\Requests\RouteMaster\StoreRouteMasterRequest;
use App\Repositories\RouteMaster\RouteMasterRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\checkPermission;
class RouteMasterController extends Controller {

    protected $routes;
    use checkPermission;
    public function __construct(
    RouteMasterRepositoryContract $routess
    ) {
        $this->routes = $routess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if(!$this->checkActionPermission('routes','view'))
            return redirect()->route('401');
        $routes = DB::table('route_master')->select('*')
                ->get();
        return view('route_master.index')->withRoutes($routes);
    }

    public function create() {
        if(!$this->checkActionPermission('routes','create'))
            return redirect()->route('401');
        //$routes = Route::findOrFail();
        return view('route_master.create');
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
    public function store(StoreRouteMasterRequest $routesRequest) {
        if(!$this->checkActionPermission('routes','create'))
            return redirect()->route('401');
        $routesRequest->route;
        $version_id = $this->getCurrentVersion();
        $routesRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
         $getInsertedId = $this->routes->create($routesRequest);
        return redirect()->route('route_master.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    
    public function viewDetail($id) {
              if(!$this->checkActionPermission('routes','view'))
                return redirect()->route('401');
            $routes=RouteMaster::find($id);
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
                            <td colspan="2"><b>Route Name</b></td>
                            <td class="table_normal"><?php echo $routes->route_name; ?></span></td>
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
        if(!$this->checkActionPermission('routes','view'))
            return redirect()->route('401');
        $routes = DB::table('route_master')->select('*')
                ->get();
        return view('route_master.index')->withRoutes($routes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        if(!$this->checkActionPermission('routes','edit'))
            return redirect()->route('401');
        $routes = RouteMaster::findOrFail($id);   //echo '<pre>';print_r($routes);die;
        return view('route_master.edit',compact('routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateRouteMasterRequest $request) {
        if(!$this->checkActionPermission('routes','edit'))
            return redirect()->route('401');
      $sql = RouteMaster::where([['route_name', $request->route_name], ['id', '!=', $id]])->first();
        if (count($sql) > 0) {
            return redirect()->back()->withErrors(['This route has already been taken.']);
        } else {
        
            $request->request->add(['approval_status'=>'p','flag'=> 'u']);
            $this->routes->update($id, $request);
            return redirect()->route('route_master.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
}
