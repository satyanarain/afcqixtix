<?php

namespace App\Http\Controllers;

use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Service;
use App\Models\BusType;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Repositories\Service\ServiceRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
class ServiceController extends Controller
{
    use activityLog;
    protected $services;
    public function __construct(
        ServiceRepositoryContract $services
    ) {
        $this->services = $services;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $services = DB::table('services')->select('services.id as id','services.name as name','services.order_number as order_number','services.short_name as short_name','bus_types.bus_type')
    ->leftjoin('bus_types', 'bus_types.id', '=', 'services.bus_type_id')->orderby('order_number')->get();
    return view('services.index')->withServices($services);
   
    }
    public function create()
    {
      return view('services.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Service $services
     * @return Response
     */
    public function store(StoreServiceRequest $servicesRequest)
    {
  
       $sql=Service::where([['bus_type_id',$servicesRequest->bus_type_id],['name',$servicesRequest->name]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Bus type and service name has already been taken.']);
      } else {    
        
        $getInsertedId = $this->services->create($servicesRequest);
        return redirect()->route('services.index');         
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
//   public function show($id)
//   {
//  $services = DB::table('services')->select('*','services.name as name','services.order_number as order_number','services.short_name as short_name','services.id as id','bus_types.bus_type')->leftjoin('bus_types', 'bus_types.id', '=', 'services.bus_type_id')
//  ->where('services.id',$id)->first();
//    return view('services.show')->withServices($services);
//     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $services=Service::findOrFail($id);
      return view('services.edit')->withServices($services);
    
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateServiceRequest $request)
    {
        $sql=Service::where([['bus_type_id',$request->bus_type_id],['name',$request->name],['id','!=',$id]])->first();
     if(count($sql)>0)
     {
       return redirect()->back()->withErrors(['Bus type and service name has already been taken.']);
      } else {    
          $this->services->update($id, $request);
        return redirect()->route('services.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Add By Satya
     * @return Response
     */
      public function sortOrder($id) {
        $array = explode(',', $id);
       $k=1;
        for ($i = 0; $i <= count($array); $i++) {
            DB::table('services')->where('id', $array[$i])->update(['order_number' => $k]);
          $k++;  
        }
        
    $services = DB::table('services')->select('services.id as id','services.name as name','services.order_number as order_number','services.short_name as short_name','bus_types.bus_type')
    ->leftjoin('bus_types', 'bus_types.id', '=', 'services.bus_type_id')->orderby('order_number')->get();
        ?>
                <thead>
                    <tr> <th>Bus Type</th>
                        <th>Order Number</th>
                        <th>Service Name</th>
                        <th>Short Name</th>
                        
                    </tr>
                </thead>
                
            <?php foreach ($services as $value) {
                ?>
                            <tr class="nor_f">
                                  <td><?php echo $value->bus_type; ?></td>
                                 <td><?php echo $value->order_number; ?></td>
                                 <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->short_name ?></td>
                                     
                                <td><a  href="<?php echo route("services.edit", $value->id) ?>" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button  class="btn btn-small btn-primary"  data-toggle="modal" onclick="viewDetails(<?php echo $value->id ?>,'view_detail')"><span class="glyphicon glyphicon-search"></span>&nbsp;View</button>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
            <?php } ?>
                </tbody>
        <?php
    }
    
    public function orderList() {
          $services = DB::table('services')->select('services.id as id','services.name as name','services.order_number as order_number','services.short_name as short_name','bus_types.bus_type')
    ->leftjoin('bus_types', 'bus_types.id', '=', 'services.bus_type_id')->orderby('order_number')->get();
        ?>
                      
        <?php foreach ($services as $value) {
        ?>
                    <li id="<?php echo "order" . $value->id; ?>" class="list-group-order-sub">
                    <a href="javascript:void(0);" ><?php echo $value->bus_type; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->order_number; ?></a>
                    <a href="javascript:void(0);"><?php echo $value->name; ?></a>
                   </li>
        <?php } ?>
                   
        <?php
    }
    
    public function viewDetail($id) {
   $value = DB::table('services')->select('services.id as id','services.name as name','services.order_number as order_number','services.short_name as short_name','bus_types.bus_type','users.user_name','services.created_at','services.updated_at')
   ->leftjoin('users', 'users.id', '=', 'services.user_id')
    ->leftjoin('bus_types', 'bus_types.id', '=', 'services.bus_type_id')->where('services.id',$id)->first()
        ?>
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-view" >
<!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                <h4 class="viewdetails_details"><span class="fa fa-briefcase"></span>&nbsp;Service</h4>
            </div>
            <div class="modal-body-view">
                 <table class="table table-responsive.view">
                    <tr>       
                        <td><b>Bus Type</b></td>
                        <td class="table_normal"><?php  echo $value->bus_type ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Service Name</b></td>
                        <td class="table_normal"><?php  echo $value->name; ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Short Name</b></td>
                        <td class="table_normal"><?php  echo $value->short_name; ?></span></td>
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
     * Display the specified resource.
     *
     * @Author satya
     * @22-02-2018
     */
   public function show($id)
   {
    $services = DB::table('services')->select('services.id as id','services.name as name','services.order_number as order_number','services.short_name as short_name','bus_types.bus_type')
    ->leftjoin('bus_types', 'bus_types.id', '=', 'services.bus_type_id')->orderby('order_number')->get();
    return view('services.index')->withServices($services);
     }
    
 }
