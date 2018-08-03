<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Denomination;
use App\Models\Duty;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Denomination\UpdateDenominationRequest;
use App\Http\Requests\Denomination\StoreDenominationRequest;
use App\Repositories\Denomination\DenominationRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DenominationController extends Controller {

    protected $denominations;

    public function __construct(
    DenominationRepositoryContract $denominations
    ) {
        $this->denominations = $denominations;
    }

    /**
     * Display a listing of the resource.
     ** @Author created by satya 5.2.2018
     * @return Response
     */
 public function index() {
                $denominations = DB::table('denominations')->select('*','denominations.id as id','denomination_masters.name as denomination_master_id')
                ->leftjoin('users', 'users.id', '=', 'denominations.user_id')
                ->leftjoin('denomination_masters', 'denomination_masters.id', '=', 'denominations.denomination_master_id')
                 ->orderby('denominations.id')       
                ->get();
                return view('denominations.index',compact('denominations'));
    }
     public function create() {
     return view('denominations.create');
    }
 /**
   public function Previous() {
    $denominations = DB::table('denominations')->select('*','denominations.id as id')
                ->leftjoin('services', 'denominations.service_id', '=', 'services.id')
                ->get();
        return view('denominations.previous')->withDenominations($denominations);
    }

    public function create() {
     return view('denominations.create');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Denomination $denominations
     * @return Response
     * @Author created by satya 5.2.2018 
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param Denomination $denominations
     * @return Response
     * * @Author created by satya 5.2.2018
     */
    public function store(StoreDenominationRequest $denominationsRequest) {
        $getInsertedId = $this->denominations->create($denominationsRequest);
        return redirect()->route('denominations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
                       $denominations = DB::table('denominations')->select('*','denominations.id as id','denomination_masters.name as denomination_master_id')
                ->leftjoin('users', 'users.id', '=', 'denominations.user_id')
                ->leftjoin('denomination_masters', 'denomination_masters.id', '=', 'denominations.denomination_master_id')
                 ->orderby('denominations.id')       
                ->get();
                return view('denominations.index',compact('denominations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @Author created by satya 5.2.2018
     * @return Response
     */
    public function edit($id) {
        $denominations = Denomination::findOrFail($id);
        return view('denominations.edit',compact('denominations'));
    }
    public function addNew(Request $request) {
       
        
        
        
        $table = $request->table_name;
        $field_name = $request->field_name;
        $name = $request->name;
        $placeholder = $request->placeholder;
        
         $sql = DB::table($table)->select('id', 'name')->where('name',$name)->first();
        if(count($sql)>0)
        {
        echo 1;   
        }else{
        $id = DB::table($table)->insertGetId(['name' => $name]);
        $sql = DB::table($table)->select('id', 'name')->get();
        ?>
        <select name="<?php echo $field_name; ?>" class="form-control" required>
        <option value=""><?php echo "Select ".$placeholder; ?></option>
        <?php foreach ($sql as $value) {
            ?>
                <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
        <?php } ?>
        </select>
              
        <?php
    }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     * * @Author created by satya 5.2.2018
     */
    public function update($id, UpdateDenominationRequest $request) {
           $denomination_master_id = $request->denomination_master_id;
      $sql=Denomination::where([['denomination_master_id',$denomination_master_id],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Denomination has already been taken.']);
      } else { 
        $this->denominations->update($id, $request);
        return redirect()->route('denominations.index');
    }
    }
 
}
