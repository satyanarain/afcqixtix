<?php

namespace App\Http\Controllers;
use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Setting;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Http\Requests\Setting\StoreSettingRequest;
use App\Repositories\Setting\SettingRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDO;
use App\Traits\checkPermission;
class SettingController extends Controller
{
    protected $settings;
    use checkPermission;
    public function __construct(
        SettingRepositoryContract $settings
    ) {
        $this->settings = $settings;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!$this->checkActionPermission('settings','view'))
            return redirect()->route('401');
        $settings = DB::table('settings')->select('*')
      ->orderBy('id','desc')->get();
        //print_r($settings);die;
        return view('settings.index')->withSettings($settings);
   
    }
    public function create()
    {
        if(!$this->checkActionPermission('settings','create'))
            return redirect()->route('401');
        //$settings = Setting::findOrFail();
        return view('settings.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Setting $settings
     * @return Response
     */
    
    public function store(StoreSettingRequest $settingsRequest)
    {
        if(!$this->checkActionPermission('settings','create'))
            return redirect()->route('401');
        //print_r($settingsRequest->all());die;
        $getInsertedId = $this->settings->create($settingsRequest);
        return redirect()->route('settings.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
       if(!$this->checkActionPermission('settings','view'))
            return redirect()->route('401');
   $settings=Setting::findOrFail($id);
    return view('settings.show')->withSettings($settings);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!$this->checkActionPermission('settings','edit'))
            return redirect()->route('401');
       $settings=Setting::findOrFail($id);
      return view('settings.edit')->withSettings($settings);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateSettingRequest $request)
    {
        if(!$this->checkActionPermission('settings','edit'))
            return redirect()->route('401');
        //print_r($request);die;
        //print_r($id);die;
        $this->settings->update($id, $request);
        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    
   
    
    
     public function viewDetail($id) {
         if(!$this->checkActionPermission('settings','view'))
            return redirect()->route('401');
        //$service = Service::find($id);
        $sql = DB::table('settings')->where('id', $id)->get();
       ?>
       <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header-view" >
        <!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                        <h4 class="viewdetails_details">Setting Details</h4>
                    </div>
                    <div class="modal-body-view">
                         <table class="table table-responsive.view">
                            <?php foreach ($sql as $value) { ?>     
                            <tr>        
                                <td>Setting Name</td>
                                <td class="table_normal"><?php echo $value->setting_name; ?></td>
                            </tr>
                            
                            <tr>
                                <td>Setting Value</td>
                                <td class="table_normal"><?php echo $value->setting_value; ?></td>
                            </tr>
                           
                             <?php } ?>   
                                   
                                </table> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                        </div>             
                </div>             

                
                          
                    </div>
                
        <?php
    }
 }
