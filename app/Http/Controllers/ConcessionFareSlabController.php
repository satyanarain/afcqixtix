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

class ConcessionFareSlabController extends Controller {

    protected $concession_fare_slabs;

    public function __construct(
    TargetRepositoryContract $concession_fare_slabs
    ) {
        $this->concession_fare_slabs = $concession_fare_slabs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $concession_fare_slabs = DB::table('concession_fare_slabs')->select('*','concession_fare_slabs.id as id')
                ->leftjoin('duties', 'concession_fare_slabs.duty_id', '=', 'duties.id')
                ->leftjoin('shifts', 'concession_fare_slabs.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'concession_fare_slabs.route_id', '=', 'routes.id')
                ->get();
        return view('concession_fare_slabs.index')->withTargets($concession_fare_slabs);
    }

    public function create() {
     return view('concession_fare_slabs.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Target $concession_fare_slabs
     * @return Response
     */
    public function store(StoreTargetRequest $concession_fare_slabsRequest) {
        $getInsertedId = $this->concession_fare_slabs->create($concession_fare_slabsRequest);
        return redirect()->route('concession_fare_slabs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        // $concession_fare_slabs=Target::findOrFail($id);
                $concession_fare_slabs = DB::table('concession_fare_slabs')->select('*','concession_fare_slabs.id as id')
                ->leftjoin('shifts', 'concession_fare_slabs.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'concession_fare_slabs.route_id', '=', 'routes.id')
                 ->where('concession_fare_slabs.id','=',$id)
                ->first();
        
       return view('concession_fare_slabs.show')->withTargets($concession_fare_slabs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $concession_fare_slabs = Target::findOrFail($id);
        return view('concession_fare_slabs.edit')->withTargets($concession_fare_slabs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateTargetRequest $request) {
        $this->concession_fare_slabs->update($id, $request);
        return redirect()->route('concession_fare_slabs.index');
    }
    public function getDuty($id) {
        if($id!='')
        {
        $sql = DB::table('duties')->select('*')->where('route_id', '=', $id)->get();
        if(count($sql)>0)
        {
?>
         <label class="required">Duty</label>
        <select class="form-control" name="duty_id">
        <?php
        foreach ($sql as $value) {
        ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->duty_number; ?></option>

        <?php } ?>
               </select> 

        <?php
    }
    }
    }
}
