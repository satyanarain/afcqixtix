<?php
namespace App\Http\Controllers;
use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\CenterStock;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CenterStock\StoreCenterStockRequest;
use App\Repositories\CenterStock\CenterStockRepository;
use App\Repositories\CenterStock\CenterStockRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
use App\Traits\checkPermission;
class CenterstockController extends Controller
{
    use activityLog;
    use checkPermission;
    protected $centerstock;
    public function __construct(
        CenterStockRepositoryContract $centerstock
    ) {
        $this->centerstock = $centerstock;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('centerstock','view'))
            return redirect()->route('401');
    //$bustypes = BusType::orderBy('order_number')->get();
    //return view('invcenterstock.index')->withBustypes($bustypes);
    return view('centerstock.index');
   
    }
    public function create()
    {
      if(!$this->checkActionPermission('centerstock','create'))
            return redirect()->route('401');
     return view('centerstock.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Bustype $bustypes
     * @return Response
     */
    public function store(StoreBusTypeRequest $bustypesRequest)
    {
        if(!$this->checkActionPermission('centerstock','create'))
            return redirect()->route('401');
        $version_id = $this->getCurrentVersion();
        $bustypesRequest->request->add(['approval_status'=>'p','flag'=> 'a','version_id'=>$version_id]);
        //echo '<pre>';print_r($bustypesRequest->all());die;
        $getInsertedId = $this->bustypes->create($bustypesRequest);
        return redirect()->route('invcenterstock.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
       if(!$this->checkActionPermission('centerstock','view'))
            return redirect()->route('401');
   $bustypes=Bustype::findOrFail($id);
    return view('invcenterstock.show')->withBustypes($bustypes);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('centerstock','edit'))
            return redirect()->route('401');
       $bustypes=Bustype::findOrFail($id);
       return view('invcenterstock.edit')->withBustypes($bustypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateBusTypeRequest $request)
    {
        if(!$this->checkActionPermission('centerstock','edit'))
            return redirect()->route('401');
    $bus_type = $request->bus_type;
     $sql=BusType::where([['bus_type',$bus_type],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Bus type has already been taken.']);
      } else { 
        
        $request->request->add(['approval_status'=>'p','flag'=> 'u']);
        $this->bustypes->update($id, $request);
        return redirect()->route('bus_types.index');
    }
    } 
    public function sortOrder($id) {
        $array = explode(',', $id);
       $k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('bus_types')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
        $bustypes = BusType::orderBy('order_number')->get();
        ?>
                <thead>
                    <tr>  <th>Bus Type</th>
                        <th>Order Number</th>
                        <th>Abbreviation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($bustypes as $value) {
                ?>
                            <tr class="nor_f">
                                <td><?php echo $value->bus_type; ?></td>
                                <td><?php echo $value->order_number; ?></td>
                                <td><?php echo $value->abbreviation ?></td>
                                <td><a  href="<?php echo route("bus_types.edit", $value->id) ?>" class="" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a style="cursor: pointer;" data-toggle="modal" onclick="viewDetails(<?php echo $value->id ?>,'view_detail')"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    
    public function orderList() {
        $bustypes = BusType::orderBy('order_number')->get();
        ?>
                      
        <?php foreach ($bustypes as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->bus_type; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->abbreviation; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
   public function viewDetail($id) {
       if(!$this->checkActionPermission('centerstock','view'))
            return redirect()->route('401');
          $value = DB::table('bus_types')->select("*",'bus_types.created_at','bus_types.updated_at','bus_types.id as id')
                  ->leftjoin('users','users.id','bus_types.user_id')
                  ->orderBy('bus_types.order_number')
                  ->where('bus_types.id',$id)->first();
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-bus"></span>&nbsp;Bus Type</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Bus Type</b></td>
                        <td class="table_normal"><?php  echo $value->bus_type ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Abbreviation</b></td>
                        <td class="table_normal"><?php  echo $value->abbreviation; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td class="table_normal"><?php echo $value->order_number; ?></td>
                    </tr>
                    <?php $this->userHistory($value->user_name,$value->created_at,$value->updated_at) ; ?>
                  </table>  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <?php   
    }
    
    
    
    
    
  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
 }
