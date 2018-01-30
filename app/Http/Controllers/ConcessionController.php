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

    protected $concessions;

    public function __construct(
    ConcessionRepositoryContract $concessions
    ) {
        $this->concessions = $concessions;
    }

    /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */
 public function index() {
                $concessions = DB::table('concessions')->select('*','concessions.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','concessions.order_number as order_number')
                ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
                ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'concessions.concession_provider_master_id')
                ->leftjoin('concession_masters', 'concession_masters.id', '=', 'concessions.concession_master_id')
                ->orderby('concessions.order_number')       
                ->get();
                
                 return view('concessions.index')->withConcessions($concessions);
    }
    
 /**
     * Display a listing of the resource.
     ** @Author created by satya 31-01-2018 
     * @return Response
     */    
    
public function sortOrder($id) {
$array = explode(',', $id);
$k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('concessions')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
         $sql = DB::table('concessions')->select('*','concessions.id as id','users.name as username','concession_provider_masters.name as concession_provider_master_id','services.name as name','concession_masters.name as con_name','concessions.order_number as order_number')
                ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
                ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
                ->leftjoin('concession_provider_masters', 'concession_provider_masters.id', '=', 'concessions.concession_provider_master_id')
                ->leftjoin('concession_masters', 'concession_masters.id', '=', 'concessions.concession_master_id')
                 ->orderby('concessions.order_number')       
                ->get();
        ?>
                <thead>
                    <tr>  <th>Service Name</th>
                        <th>Order Number</th>
                        <th>Concession Provider</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($sql as $value) {
                ?>
                            <tr class="nor_f">
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->concession_provider_master_id ?></td>
                                <td><a  href="<?php echo route("concessions.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#<?php echo $id ?>"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    
    
    
 public function Previous() {
    $concessions = DB::table('fare_logs')->select('*','fare_logs.id as id')
                ->leftjoin('services', 'fare_logs.service_id', '=', 'services.id')
                ->get();
        return view('concessions.previous')->withConcessions($concessions);
    }

    public function create() {
     return view('concessions.create');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Concession $concessions
     * @return Response
     * @Author created by satya 31-01-2018  
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Concession $concessions
     * @return Response
     * * @Author created by satya 31-01-2018 
     */
    public function store(StoreConcessionRequest $concessionsRequest) {
        $getInsertedId = $this->concessions->create($concessionsRequest);
        return redirect()->route('concessions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
                $concessions = DB::table('concessions')->select('*','concessions.id as id','users.name as username','services.name as name')
                ->leftjoin('users', 'users.id', '=', 'concessions.user_id')
                ->leftjoin('services', 'concessions.service_id', '=', 'services.id')
                ->get();
                 return view('concessions.index')->withConcessions($concessions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @Author created by satya 31-01-2018 
     * @return Response
     */
    public function edit($id) {
        $concessions = Concession::findOrFail($id);
        return view('concessions.edit',compact('concessions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 31-01-2018 
     */
    public function update($id, UpdateConcessionRequest $request) {
        $this->concessions->update($id, $request);
        return redirect()->route('concessions.index');
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
