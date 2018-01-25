<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Concession;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Concession\UpdateConcessionRequest;
use App\Http\Requests\Concession\StoreConcessionRequest;
use App\Repositories\Concession\ConcessionRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ConcessionController extends Controller {

    protected $concession_fare_slabs;

    public function __construct(
    ConcessionRepositoryContract $concession_fare_slabs
    ) {
        $this->concession_fare_slabs = $concession_fare_slabs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
 public function index() {
                $concession_fare_slabs = DB::table('concession_fare_slabs')->select('*','concession_fare_slabs.id as id','users.name as username','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'concession_fare_slabs.user_id')
                ->leftjoin('services', 'concession_fare_slabs.service_id', '=', 'services.id')
                ->get();
                 return view('concession_fare_slabs.index')->withConcessions($concession_fare_slabs);
    }
 public function Previous() {
    $concession_fare_slabs = DB::table('fare_logs')->select('*','fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('concession_fare_slabs.previous')->withConcessions($concession_fare_slabs);
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
     * @param Concession $concession_fare_slabs
     * @return Response
     */
    public function store(StoreConcessionRequest $concession_fare_slabsRequest) {
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
                $concession_fare_slabs = DB::table('concession_fare_slabs')->select('*','concession_fare_slabs.id as id','users.name as username','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'concession_fare_slabs.user_id')
                ->leftjoin('services', 'concession_fare_slabs.service_id', '=', 'services.id')
                ->get();
                 return view('concession_fare_slabs.index')->withConcessions($concession_fare_slabs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $concession_fare_slabs = Concession::findOrFail($id);
        return view('concession_fare_slabs.edit',compact('concession_fare_slabs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateConcessionRequest $request) {
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
