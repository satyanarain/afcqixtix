<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Target;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Target\UpdateTargetRequest;
use App\Http\Requests\Target\StoreTargetRequest;
use App\Repositories\Target\TargetRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\checkPermission;
class TargetController extends Controller {
    use checkPermission;
    protected $targets;

    public function __construct(
    TargetRepositoryContract $targets
    ) {
        $this->targets = $targets;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($route_master_id,$duty_id,Request $request)
    {
        if(!$this->checkActionPermission('targets','view'))
            return redirect()->route('401');
        $targets = DB::table('targets')->select('*','targets.id as id')
                ->leftjoin('duties', 'targets.duty_id', '=', 'duties.id')
                ->leftjoin('shifts', 'targets.shift_id', '=', 'shifts.id')
                ->leftjoin('route_master', 'targets.route_id', '=', 'route_master.id')
                ->where('targets.route_id',$route_master_id)
                ->where('targets.duty_id',$duty_id)
                ->orderBy('duties.order_number')
                ->get();
        return view('targets.index',compact('targets','route_master_id','duty_id'));
    }

    public function create($route_master_id,$duty_id){
        if(!$this->checkActionPermission('targets','create'))
            return redirect()->route('401');
        return view('targets.create', compact('route_master_id','duty_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Target $targets
     * @return Response
     */
    public function store($route_master_id,$duty_id,StoreTargetRequest $targetsRequest) {
     if(!$this->checkActionPermission('targets','create'))
            return redirect()->route('401');
//     echo $route_master_id;
//     echo $duty_id;
//     echo '<pre>';print_r($targetsRequest->all());die;
      $sql=Target::where([['trip',$targetsRequest->trip],['route_id',$route_master_id],['duty_id',$duty_id],['shift_id',$targetsRequest->shift_id]])->first();
    
     if(count($sql)>0)
     {
        return view('targets.create')->withErrors(['This route,duty number, shift  and Trip has already been taken.']);
      } else {
            $version_id = $this->getCurrentVersion();
            $targetsRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
          $targetsRequest->request->add(['route_id'=> $route_master_id]);
          $targetsRequest->request->add(['duty_id'=> $duty_id]);
          $getInsertedId = $this->targets->create($targetsRequest);
        return redirect()->route('route_master.duties.targets.index',[$route_master_id,$duty_id]);
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if(!$this->checkActionPermission('targets','view'))
            return redirect()->route('401');
        // $targets=Target::findOrFail($id);
                $targets = DB::table('targets')->select('*','targets.id as id')
                ->leftjoin('shifts', 'targets.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'targets.route_id', '=', 'routes.id')
                 ->where('targets.id','=',$id)
                ->first();
        
       return view('targets.show')->withTargets($targets);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($route_master_id,$duty_id,$id) {
        if(!$this->checkActionPermission('targets','edit'))
            return redirect()->route('401');
        $targets = Target::findOrFail($id);
        $trips_res = DB::table('trip_details')
                    ->select('*')
                    ->where('trip_id', '=',$targets->id)
                    ->get();
        
        foreach($trips_res as $row){
            $trips[$row->trip_no] = $row->trip_no;
        }
//        echo '<pre>';
//        print_r($targets);
//        print_r($trips);die;    
        return view('targets.edit',compact('targets','route_master_id','duty_id','trips'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($route_master_id,$duty_id,$id, UpdateTargetRequest $request) {
        if(!$this->checkActionPermission('targets','edit'))
            return redirect()->route('401');
  $sql=Target::where([['route_id',$request->route_master_id],['duty_id',$request->duty_id],['shift_id',$request->shift_id],['id','!=',$id]])->first();
 
     if(count($sql)>0)
     {
      return redirect('targets/'.$id.'/edit')->withErrors(['This route and duty number has already been taken.']);
      } else {
        $request->request->add(['approval_status'=>'p','flag'=> 'u']);
        $this->targets->update($id, $request);
        return redirect()->route('route_master.duties.targets.index',[$route_master_id,$duty_id]);
      }
    }
    public function getDuty($id) {
               if($id!='')
        {
        $sql = DB::table('duties')->select('*')->where('route_id', '=', $id)->get();
         $sql_shift = DB::table('shifts')->select('*')->get();
        if(count($sql)>0)
        {
?>
<div class="form-group">
<label class="col-md-3 control-label">Duty</label>
         <div class="col-md-7 col-sm-12 required">
        <select class="col-md-6 form-control" name="duty_id">
        <?php
        foreach ($sql as $value) {
        ?>
        <option value="<?php echo $value->id; ?>"><?php echo $value->duty_number; ?></option>

        <?php } ?>
               </select> 
</div>
</div>
 <?php
    }
    }
    }
    
    
    public function getTripList(Request $request)
    {
        try
        {
            $query = DB::table('trips')
                    ->select('trips.id as trip_id')
                    ->where('route_id', '=',$request->route_master_id)
                    ->where('duty_id', '=',$request->duty_id)
                    ->where('shift_id', '=',$request->shift_id)
                    ->first();
            $trip_id = $query->trip_id;
            if(count($query) < 1)
            {
                $result = array('code'=>404, "description"=>"No Records Found");
                return response()->json($result, 404);
            }
            else
            {
                $query1 = DB::table('trip_details')
                    ->select('*')
                    ->where('trip_id', '=',$trip_id)
                    ->get();
              $result = array('data'=>$query1,'code'=>200);
              return response()->json($result, 200);
            }        
        }
        catch(Exception $e)
        {
          return response()->json(['error' => 'Something is wrong'], 500);
        }
    }
}
