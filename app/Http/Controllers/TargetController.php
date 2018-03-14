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

class TargetController extends Controller {

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
    public function index() {

        $targets = DB::table('targets')->select('*','targets.id as id')
                ->leftjoin('duties', 'targets.duty_id', '=', 'duties.id')
                ->leftjoin('shifts', 'targets.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'targets.route_id', '=', 'routes.id')
                ->get();
        return view('targets.index')->withTargets($targets);
    }

    public function create() {
     return view('targets.create');
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
    public function store(StoreTargetRequest $targetsRequest) {
     
      $sql=Target::where([['route_id',$targetsRequest->route_id],['duty_id',$targetsRequest->duty_id],['shift_id',$targetsRequest->shift_id]])->first();
    
     if(count($sql)>0)
     {
     return view('targets.create')->withErrors(['This route,duty number and shift has already been taken.']);
      } else {
          $getInsertedId = $this->targets->create($targetsRequest);
        return redirect()->route('targets.index');
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
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
    public function edit($id) {
        $targets = Target::findOrFail($id);
        return view('targets.edit')->withTargets($targets);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateTargetRequest $request) {
  $sql=Target::where([['route_id',$request->route_id],['duty_id',$request->duty_id],['shift_id',$request->shift_id],['id','!=',$id]])->first();
 
     if(count($sql)>0)
     {
      return redirect('targets/'.$id.'/edit')->withErrors(['This route and duty number has already been taken.']);
      } else {
         
        $this->targets->update($id, $request);
        return redirect()->route('targets.index');
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
