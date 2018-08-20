<?php

namespace App\Http\Controllers;
use Gate;
use Carbon;
use Notifynder;
use DB;
use Schema;
use Response;
use App\Models\Version;
use App\Models\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Version\UpdateVersionRequest;
use App\Http\Requests\Version\StoreVersionRequest;
use App\Repositories\Version\VersionRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDO;

class VersionController extends Controller
{
    protected $versions;
    public function __construct(
        VersionRepositoryContract $versions
    ) {
        $this->versions = $versions;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $versions = DB::table('versions')->select('*')
      ->orderBy('id','desc')->get();
        //print_r($versions);die;
        return view('versions.index')->withVersions($versions);
   
    }
    public function create()
    {
        //$versions = Version::findOrFail();
        return view('versions.create');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param Version $versions
     * @return Response
     */
    public function query($qs,$pdo){
	if($pdo){
		if(is_array($qs))$lock=1;
		else{$lock=0;$qs=array($qs);}
		if($lock){
			$pdo->exec('PRAGMA synchronous = 0;');
			$pdo->exec('PRAGMA journal_mode = OFF;');
			$pdo->exec('BEGIN;');
		}
		foreach($qs as $q)
			$pdo->exec($q);
		if($lock){
			$pdo->exec('COMMIT;');
			$pdo->exec('PRAGMA synchronous = FULL;');
			$pdo->exec('PRAGMA journal_mode = DELETE;');
		}
		$err=$pdo->errorInfo();
		if(intval($err[0])){
			echo "\nError: \n";
			var_dump($q,$err);
			#die;
		}
	}
}
    public function store(StoreVersionRequest $versionsRequest)
    {
        //print_r($versionsRequest->all());die;
        $getInsertedId = $this->versions->create($versionsRequest);
        return redirect()->route('versions.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
   $versions=Version::findOrFail($id);
    return view('versions.show')->withVersions($versions);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //die('f');
       $versions=Version::findOrFail($id);
      return view('versions.edit')->withVersions($versions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateVersionRequest $request)
    {
        //print_r($request);die;
        //print_r($id);die;
        $this->versions->update($id, $request);
        if($request->version_status=="c")
            $this->approveVersion($id);
        return redirect()->route('versions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    
    public function approveVersion($version_id)
    {
        
        //echo public_path();die;
        $vals=array();
        $pdoMy=new PDO('mysql:dbname=afcqixtix','root','') or die("can't connect to afc");
        $pdoLi=new PDO('sqlite:'.public_path().'/supportingdocs/data'.$version_id.'.sqlite') or die("can't connect to data1");

        $tbls=array('bus_types','concessions','concession_fare_slabs','concession_masters','concession_provider_masters',
            'countries','crew','denominations','depots','duties','fares','inspector_remarks',
            'pass_types','payout_reasons','routes','route_details','stops','services','shifts',
            'versions','targets','trips','trip_cancellation_reasons','trip_cancellation_reason_category_masters',
            'trip_details','trip_start','vehicles');
            #Delete Old Table
            //$deleted_extra_arr = array('ETM_detail_logs','ETM_details','abstractbills','bus_type_logs','concession_fare_slab_logs','concession_logs','concession_masters','concession_provider_masters','crew_detail_logs','denomination_logs','denomination_masters','departments','depot_logs','depots111','depots1111','dutie_logs','etm_hot_key_masters','evm_status_masters','fare_logs','fares_copy','inspector_remark_logs','migrations','pass_type_logs','password_resets','payout_reason_logs','permission_details','permission_modules','permissions','roles','route_logs','service_logs','settings','shift_logs','stop_logs','target_logs','trip_cancellation_reason_logs','trip_logs','users','vehicle_logs');
            foreach ($tbls as $table)
            {
                //$result = $db->query('delete from '.$table);
                $result = $pdoLi->query('drop table '.$table);
            }
            #Create Table
            foreach($tbls as $tbl){
                    //echo "creating table '$tbl'\n";
                    $q=$pdoMy->query("SELECT * FROM `$tbl` LIMIT 1");
                    $cols=array();
                    for($i=0;$i<$q->columnCount();++$i){
                            $m=(object)$q->getColumnMeta($i);
                            $type=isset($m->native_type)?$m->native_type:'';
                            $def="\t$m->name $type";
                            if(in_array('unique_key',$m->flags))$def.=" UNIQUE";
                            if(in_array('primary_key',$m->flags))$def.=" PRIMARY KEY";
                            if(in_array('not_null',$m->flags))$def.=" NOT NULL";
                            $cols[]=$def;
                    }
                    //print_r($cols);
                    $this->query("CREATE TABLE IF NOT EXISTS $tbl(\n".implode(",\n",$cols)."\n);\n",$pdoLi);
            }



            #Insert Rows
            foreach($tbls as $tbl){
                    //echo "inserting data into '$tbl'\n";
                    $qs=array();$i=0;
                    $q=$pdoMy->query("SELECT * FROM `$tbl`");
                    while($d=$q->fetch(5)){
                            $vals=$keys=array();
                            foreach($d as $k=>$v){
                                    if($k=='queryString') continue;
                                    $keys[]=$k;
                                    $vals[]=$pdoLi->quote($v);
                            }
                            $qs[]="INSERT OR IGNORE INTO $tbl (".implode(',',$keys).") VALUES  (".implode(',',$vals).");\n";
                            ++$i;
                            if($i>=5000){
                                    $this->query($qs,$pdoLi);
                                    $qs=array();
                                    $i=0;
                            }
                    }
                    $this->query($qs,$pdoLi);
            }
        $pdoMy->query("INSERT INTO sqlite_db_name(`name`) VALUES  ('data".$version_id.".sqlite')");
    }
    
    
     public function viewDetail($id) {
        //$service = Service::find($id);
        $sql = DB::table('versions')->where('id', $id)->get();
       ?>
       <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header-view" >
        <!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                        <h4 class="viewdetails_details">Version Details</h4>
                    </div>
                    <div class="modal-body-view">
                         <table class="table table-responsive.view">
                            <?php foreach ($sql as $value) { ?>     
                            <tr>        
                                <td>Version ID</td>
                                <td class="table_normal"><?php echo $value->id; ?></td>
                            </tr>
                            <tr>
                                <td>Download From</td>
                                <td class="table_normal"><?php echo $value->downloading_wef; ?></td>
                            </tr>
                            <tr>
                                <td>Version Status</td>
                                <td class="table_normal"><?php echo $value->version_status; ?></td>
                            </tr>
                            <tr>
                                <td>Reason</td>
                                <td class="table_normal"><?php echo $value->reason; ?></td>
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
