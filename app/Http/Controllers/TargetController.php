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
    public function index($route_id,$duty_id,Request $request)
    {
        if(!$this->checkActionPermission('targets','view'))
            return redirect()->route('401');
        $targets = DB::table('targets')->select('*','targets.id as id')
                ->leftjoin('duties', 'targets.duty_id', '=', 'duties.id')
                ->leftjoin('shifts', 'targets.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'targets.route_id', '=', 'routes.id')
                ->get();
        return view('targets.index',compact('targets','route_id','duty_id'));
    }

    public function create($route_id,$duty_id){
        if(!$this->checkActionPermission('targets','create'))
            return redirect()->route('401');
        return view('targets.create', compact('route_id','duty_id'));
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
    public function store($route_id,$duty_id,StoreTargetRequest $targetsRequest) {
     if(!$this->checkActionPermission('targets','create'))
            return redirect()->route('401');
      $sql=Target::where([['route_id',$targetsRequest->route_id],['duty_id',$targetsRequest->duty_id],['shift_id',$targetsRequest->shift_id]])->first();
    
     if(count($sql)>0)
     {
     return view('targets.create')->withErrors(['This route,duty number and shift has already been taken.']);
      } else {
            $version_id = $this->getCurrentVersion();
            $targetsRequest->request->add(['flag'=> 'a','version_id'=>$version_id]);
          $targetsRequest->request->add(['route_id'=> $route_id]);
          $targetsRequest->request->add(['duty_id'=> $duty_id]);
          $getInsertedId = $this->targets->create($targetsRequest);
        return redirect()->route('routes.duties.targets.index',[$route_id,$duty_id]);
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
    public function edit($route_id,$duty_id,$id) {
        if(!$this->checkActionPermission('targets','edit'))
            return redirect()->route('401');
        $targets = Target::findOrFail($id);
        return view('targets.edit',compact('targets','route_id','duty_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($route_id,$duty_id,$id, UpdateTargetRequest $request) {
        if(!$this->checkActionPermission('targets','edit'))
            return redirect()->route('401');
  $sql=Target::where([['route_id',$request->route_id],['duty_id',$request->duty_id],['shift_id',$request->shift_id],['id','!=',$id]])->first();
 
     if(count($sql)>0)
     {
      return redirect('targets/'.$id.'/edit')->withErrors(['This route and duty number has already been taken.']);
      } else {
        $request->request->add(['flag'=> 'u']);
        $this->targets->update($id, $request);
        return redirect()->route('routes.duties.targets.index',['route_id','duty_id']);
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
}
