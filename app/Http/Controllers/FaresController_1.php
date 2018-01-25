<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Fare;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fare\UpdateFareRequest;
use App\Http\Requests\Fare\StoreFareRequest;
use App\Repositories\Fare\FareRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FaresController extends Controller {

    protected $fares;

    public function __construct(
    FareRepositoryContract $fares
    ) {
        $this->fares = $fares;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
 public function index() {
                $fares = DB::table('fares')->select('*','fares.id as id','users.name as username','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'fares.user_id')
                ->leftjoin('services', 'fares.service_id', '=', 'services.id')
                ->get();
               
                return view('fares.index')->withFares($fares);
    }
 public function Previous() {
    $fares = DB::table('fare_logs')->select('*','fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('fares.previous')->withFares($fares);
    }

    public function create() {
     return view('fares.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Fare $fares
     * @return Response
     */
    public function store(StoreFareRequest $faresRequest) {
        $getInsertedId = $this->fares->create($faresRequest);
        return redirect()->route('fares.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        // $fares=Fare::findOrFail($id);
                $fares = DB::table('fares')->select('*','fares.id as id')
                ->leftjoin('shifts', 'fares.shift_id', '=', 'shifts.id')
                ->leftjoin('routes', 'fares.route_id', '=', 'routes.id')
                 ->where('fares.id','=',$id)
                ->first();
        
       return view('fares.show')->withFares($fares);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $fares = Fare::findOrFail($id);
        return view('fares.edit')->withFares($fares);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateFareRequest $request) {
        $this->fares->update($id, $request);
        return redirect()->route('fares.index');
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
