<?php
namespace App\Http\Controllers\Inventory;

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
use App\Http\Requests\Inventory\CenterStock\StoreCenterStockRequest;
use App\Repositories\Inventory\CenterStock\CenterStockRepository;
use App\Repositories\Inventory\CenterStock\CenterStockRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
use App\Traits\checkPermission;

class CenterstockController extends Controller
{
    use activityLog;
    use checkPermission;
    protected $centerstock;
    public function __construct(CenterStockRepositoryContract $centerstock) 
    {
        $this->centerstock = $centerstock;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('centerstocks','view'))
            return redirect()->route('401');
      
        //$centerstock = CenterStock::orderBy('id')->get();
        $centerstock = DB::table('inv_center_stock')->select('inv_center_stock.*','inv_items_master.name','denominations.description')
                ->leftjoin('inv_items_master', 'inv_center_stock.items_id', '=', 'inv_items_master.id')
                ->leftjoin('denominations', 'inv_center_stock.denom_id', '=', 'denominations.id')
                ->get();
        //return view('invcenterstock.index')->withBustypes($bustypes);
        return view('inventory.centerstock.index',compact('centerstock'));   
    }

    public function create()
    {
        if(!$this->checkActionPermission('centerstocks','create'))
            return redirect()->route('401');
        $items_data = DB::table("inv_items_master")->select('id','name','description')->where("status", "=", '1')->get();
        $paperticket = DB::table("denominations")->select('id','description','denomination_master_id')->where("denomination_master_id", "=", '1')->get();
        return view('inventory.centerstock.create',compact('items_data','paperticket'));
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
    public function store(StoreCenterStockRequest $request)
    {
        if(!$this->checkActionPermission('centerstocks','create'))
            return redirect()->route('401');
      
        $getInsertedId = $this->centerstock->create($request);
        return redirect()->route('inventory.centerstock.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(!$this->checkActionPermission('centerstocks','view'))
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
        if(!$this->checkActionPermission('centerstocks','edit'))
            return redirect()->route('401');

        $stock = CenterStock::findOrFail($id);
        $items_data = DB::table("inv_items_master")->select('id','name','description')->where("status", "=", '1')->get();
        $paperticket = DB::table("denominations")->select('id','description','denomination_master_id')->where("denomination_master_id", "=", '1')->get();

        return view('inventory.centerstock.edit', compact('stock', 'items_data', 'paperticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, StoreCenterStockRequest $request)
    {
        if(!$this->checkActionPermission('centerstocks','edit'))
            return redirect()->route('401');
        
        $getInsertedId = $this->centerstock->update($id, $request);
        return redirect()->route('inventory.centerstock.index');   
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
                    <tr>    
                            <th>@lang('Items')</th>
                            <th>@lang('Denominations')</th>
                            <th>@lang('Series')</th>
                            <th>@lang('Start Sequence')</th>
                            <th>@lang('End Sequence')</th>
                            <th>@lang('Quantity')</th>
                            <th>@lang('Vender_name')</th>
                            <th>@lang('Date Received')</th>
                            <th>@lang('Challan Number')</th>
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
       if(!$this->checkActionPermission('centerstocks','view'))
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
