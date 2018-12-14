<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\ConcessionFareSlab;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConcessionFareSlab\UpdateConcessionFareSlabRequest;
use App\Http\Requests\ConcessionFareSlab\StoreConcessionFareSlabRequest;
use App\Repositories\ConcessionFareSlab\ConcessionFareSlabRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\checkPermission;
class ConcessionFareSlabController extends Controller {
    use checkPermission;
    protected $concession_fare_slabs;

    public function __construct(
    ConcessionFareSlabRepositoryContract $concession_fare_slabs
    ) {
        $this->concession_fare_slabs = $concession_fare_slabs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
 public function index($bus_type_id,$service_id)
{
     if(!$this->checkActionPermission('concession_fare_slabs','view'))
            return redirect()->route('401');
    $concessionFareSlabs = DB::table('concession_fare_slabs')
    ->select('*','concession_fare_slabs.id as id','users.name as username','services.name as name')
    ->leftjoin('users', 'users.id', '=', 'concession_fare_slabs.user_id')
    ->leftjoin('services', 'concession_fare_slabs.service_id', '=', 'services.id')
    ->where('service_id', $service_id)
    ->get();
    //echo '<pre>';print_r($concession_fare_slabs);die;
     return view('concession_fare_slabs.index',compact('concessionFareSlabs','bus_type_id','service_id'));
}
 public function Previous() {
    $concession_fare_slabs = DB::table('fare_logs')->select('*','fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('concession_fare_slabs.previous')->withConcessionFareSlabs($concession_fare_slabs);
    }

    public function create($bus_type_id,$service_id,Request $request) {
        if(!$this->checkActionPermission('concession_fare_slabs','create'))
            return redirect()->route('401');
        return view('concession_fare_slabs.create',compact('bus_type_id','service_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param ConcessionFareSlab $concession_fare_slabs
     * @return Response
     */
    public function store($bus_type_id,$service_id,StoreConcessionFareSlabRequest $concession_fare_slabsRequest) {
        if(!$this->checkActionPermission('concession_fare_slabs','create'))
            return redirect()->route('401');
        $version_id = $this->getCurrentVersion();
        $concession_fare_slabsRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
        $concession_fare_slabsRequest->request->add(['service_id'=> $service_id]);
        $getInsertedId = $this->concession_fare_slabs->create($concession_fare_slabsRequest);
        return redirect()->route('bus_types.services.concession_fare_slabs.index',[$bus_type_id,$service_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if(!$this->checkActionPermission('concession_fare_slabs','view'))
            return redirect()->route('401');
                $concession_fare_slabs = DB::table('concession_fare_slabs')->select('*','concession_fare_slabs.id as id','users.name as username','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'concession_fare_slabs.user_id')
                ->leftjoin('services', 'concession_fare_slabs.service_id', '=', 'services.id')
                ->get();
                 return view('concession_fare_slabs.index')->withConcessionFareSlabs($concession_fare_slabs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($bus_type_id,$service_id,$id) {
        if(!$this->checkActionPermission('concession_fare_slabs','edit'))
            return redirect()->route('401');
        $concession_fare_slabs = ConcessionFareSlab::findOrFail($id);
        return view('concession_fare_slabs.edit',compact('concession_fare_slabs','service_id','bus_type_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($bus_type_id,$service_id,$id, UpdateConcessionFareSlabRequest $request) {
        if(!$this->checkActionPermission('concession_fare_slabs','edit'))
            return redirect()->route('401');
        
        $request->request->add(['approval_status'=>'p','flag'=> 'u']);
        $request->request->add(['service_id'=> $service_id]);
        $this->concession_fare_slabs->update($id, $request);
        return redirect()->route('bus_types.services.concession_fare_slabs.index',[$bus_type_id,$service_id]);
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
