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
use App\Traits\checkPermission;
class VersionController extends Controller
{
    protected $versions;
    use checkPermission;
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
        if(!$this->checkActionPermission('versions','view'))
            return redirect()->route('401');
        $versions = DB::table('versions')->select('*')
      ->orderBy('id','desc')->get();
        //print_r($versions);die;
        return view('versions.index')->withVersions($versions);
   
    }
    public function create()
    {
        if(!$this->checkActionPermission('versions','create'))
            return redirect()->route('401');
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
        if(!$this->checkActionPermission('versions','create'))
            return redirect()->route('401');
        //print_r($versionsRequest->all());die;
        $versionsRequest->request->add(['version_open'=> date('Y-m-d H:i:s')]);
        //echo '<pre>';print_r($versionsRequest->all());die;
        $getInsertedId = $this->versions->create($versionsRequest);
        $this->openVersion();
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
       if(!$this->checkActionPermission('versions','view'))
            return redirect()->route('401');
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
        if(!$this->checkActionPermission('versions','edit'))
            return redirect()->route('401');
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
        if(!$this->checkActionPermission('versions','edit'))
            return redirect()->route('401');
        
        if($request->version_status=="c")
        {
            $diff = $this->getAllDifferences();
            if(count($diff))
            {
                Session::flash('error', "You can't Close the Version untill you Approve/Deny all changes.");
                return redirect()->route('versions.edit',$id);
            }else{
                $this->approveVersion($id);
                $request->request->add(['version_close'=> date('Y-m-d H:i:s')]);
            }
        }
        $this->versions->update($id, $request);
        if($request->version_status=="c" && count($diff)==0)
        {
            $this->closeVersion();
        }
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
        $dbname = env('DB_DATABASE');
        $pdoMy=new PDO('mysql:dbname='.$dbname, env('DB_USERNAME'), env('DB_PASSWORD')) or die("can't connect to afc");
        
        $pdoLi=new PDO('sqlite:'.public_path().'/supportingdocs/data'.$version_id.'.sqlite') or die("can't connect to data1");

        $tbls=array('depots','vehicles','crew','bus_types','services','fares','concession_fare_slabs','concessions',
            'pass_types','shifts','stops','route_master','routes','route_details','duties','trips','trip_details',
            'targets','trip_cancellation_reasons','inspector_remarks','payout_reasons','denominations',
            'etm_details','versions','trip_cancellation_reason_category_masters',
            'trip_start','concession_masters','concession_provider_masters','countries');
            #Delete Old Table
            //$deleted_extra_arr = array('ETM_detail_logs','etm_details','abstractbills','bus_type_logs','concession_fare_slab_logs','concession_logs','concession_masters','concession_provider_masters','crew_detail_logs','denomination_logs','denomination_masters','departments','depot_logs','depots111','depots1111','dutie_logs','etm_hot_key_masters','etm_status_masters','fare_logs','fares_copy','inspector_remark_logs','migrations','pass_type_logs','password_resets','payout_reason_logs','permission_details','permission_modules','permissions','roles','route_logs','service_logs','settings','shift_logs','stop_logs','target_logs','trip_cancellation_reason_logs','trip_logs','users','vehicle_logs');
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
    
    
    public function viewDetail($tablename,$id,$logtable) {
         if(!$this->checkActionPermission('versions','view'))
            return redirect()->route('401');
        //$service = Service::find($id);
        $sql = DB::table($tablename)->where('id', $id)->first();//print_r($sql);die;
        $prev_version_id = $sql->version_id-1;
        $olddata = DB::table($logtable)->where('id', $sql->id)->where('version_id', $prev_version_id)->first();
        //echo '<pre>'; print_r($sql);print_r($olddata);die;
        
       ?>
       <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header-view" >
        <!--                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>-->
                        <h4 class="viewdetails_details"><?php echo strtoupper(str_replace('_',' ',$tablename))?> Details</h4>
                    </div>
                    <div class="modal-body-view">
                         <table class="table table-responsive.view">
                            <?php if($sql->flag=='u'){?>
                             <tr>
                                 <td></td>
                                 <td>Current Value</td>
                                 <td>Old Value</td>
                             </tr>
                            <?php }?>
                            <?php foreach ($sql as $key=>$value) { ?>     
                            <tr>        
                                <td><?=strtoupper(str_replace('_',' ',$key))?></td>
                                <td class="table_normal"><?php echo $value; ?></td>
                                <?php if($sql->flag=='u'){?>
                                <td class="table_normal"><?php echo $olddata->$key; ?></td>
                                <?php }?>
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
    
    public function openVersion()
    {
        $version_id = $this->getCurrentVersion();
        
        //echo public_path();die;
        $vals=array();

        $dbname = env('DB_DATABASE');
        $pdoLi=new PDO('mysql:dbname='.$dbname, env('DB_USERNAME'), env('DB_PASSWORD')) or die("can't connect to afc");
        
        $result = $pdoLi->query('INSERT INTO bus_type_logs SELECT * FROM bus_types');
        $result = $pdoLi->query('INSERT INTO concession_fare_slab_logs SELECT * FROM concession_fare_slabs');
        $result = $pdoLi->query('INSERT INTO concession_logs SELECT * FROM concessions');
        $result = $pdoLi->query('INSERT INTO crew_logs SELECT * FROM crew');
        $result = $pdoLi->query('INSERT INTO denomination_logs SELECT * FROM denominations');
        $result = $pdoLi->query('INSERT INTO depot_logs SELECT * FROM depots');
        $result = $pdoLi->query('INSERT INTO dutie_logs SELECT * FROM duties');
        $result = $pdoLi->query('INSERT INTO etm_detail_logs SELECT * FROM etm_details');
        $result = $pdoLi->query('INSERT INTO fare_logs SELECT * FROM fares');
        $result = $pdoLi->query('INSERT INTO inspector_remark_logs SELECT * FROM inspector_remarks');
        $result = $pdoLi->query('INSERT INTO pass_type_logs SELECT * FROM pass_types');
        $result = $pdoLi->query('INSERT INTO payout_reason_logs SELECT * FROM payout_reasons');
        $result = $pdoLi->query('INSERT INTO route_detail_logs SELECT * FROM route_details');
        $result = $pdoLi->query('INSERT INTO route_logs SELECT * FROM routes');
        $result = $pdoLi->query('INSERT INTO route_master_log SELECT * FROM route_master');
        $result = $pdoLi->query('INSERT INTO service_logs SELECT * FROM services');
        $result = $pdoLi->query('INSERT INTO shift_logs SELECT * FROM shifts');
        $result = $pdoLi->query('INSERT INTO stop_logs SELECT * FROM stops');
        $result = $pdoLi->query('INSERT INTO target_logs SELECT * FROM targets');
        $result = $pdoLi->query('INSERT INTO trip_cancellation_reason_logs SELECT * FROM trip_cancellation_reasons');
        $result = $pdoLi->query('INSERT INTO trip_detail_logs SELECT * FROM trip_details');
        $result = $pdoLi->query('INSERT INTO trip_logs SELECT * FROM trips');
        $result = $pdoLi->query('INSERT INTO vehicle_logs SELECT * FROM vehicles');
        $query = DB::table('bus_types')->update(['version_id' => $version_id]);
        $query = DB::table('concession_fare_slabs')->update(['version_id' => $version_id]);
        $query = DB::table('concessions')->update(['version_id' => $version_id]);
        $query = DB::table('crew')->update(['version_id' => $version_id]);
        $query = DB::table('denominations')->update(['version_id' => $version_id]);
        $query = DB::table('depots')->update(['version_id' => $version_id]);
        $query = DB::table('duties')->update(['version_id' => $version_id]);
        $query = DB::table('etm_details')->update(['version_id' => $version_id]);
        $query = DB::table('fares')->update(['version_id' => $version_id]);
        $query = DB::table('inspector_remarks')->update(['version_id' => $version_id]);
        $query = DB::table('pass_types')->update(['version_id' => $version_id]);
        $query = DB::table('payout_reasons')->update(['version_id' => $version_id]);
        $query = DB::table('route_details')->update(['version_id' => $version_id]);
        $query = DB::table('routes')->update(['version_id' => $version_id]);
        $query = DB::table('services')->update(['version_id' => $version_id]);
        $query = DB::table('shifts')->update(['version_id' => $version_id]);
        $query = DB::table('stops')->update(['version_id' => $version_id]);
        $query = DB::table('targets')->update(['version_id' => $version_id]);
        $query = DB::table('trip_cancellation_reasons')->update(['version_id' => $version_id]);
        $query = DB::table('trip_details')->update(['version_id' => $version_id]);
        $query = DB::table('trips')->update(['version_id' => $version_id]);
        $query = DB::table('vehicles')->update(['version_id' => $version_id]);
        
        
            
        
        
    }
    
    public function closeVersion()
    {
//        $query = DB::table('bus_types')->update(['flag' => '']);
//        $query = DB::table('concession_fare_slabs')->update(['flag' => '']);
//        $query = DB::table('concessions')->update(['flag' => '']);
//        $query = DB::table('crew')->update(['flag' => '']);
//        $query = DB::table('denominations')->update(['flag' => '']);
//        $query = DB::table('depots')->update(['flag' => '']);
//        $query = DB::table('duties')->update(['flag' => '']);
//        $query = DB::table('etm_details')->update(['flag' => '']);
//        $query = DB::table('fares')->update(['flag' => '']);
//        $query = DB::table('inspector_remarks')->update(['flag' => '']);
//        $query = DB::table('pass_types')->update(['flag' => '']);
//        $query = DB::table('payout_reasons')->update(['flag' => '']);
//        $query = DB::table('route_details')->update(['flag' => '']);
//        $query = DB::table('routes')->update(['flag' => '']);
//        $query = DB::table('services')->update(['flag' => '']);
//        $query = DB::table('shifts')->update(['flag' => '']);
//        $query = DB::table('stops')->update(['flag' => '']);
//        $query = DB::table('targets')->update(['flag' => '']);
//        $query = DB::table('trip_cancellation_reasons')->update(['flag' => '']);
//        $query = DB::table('trip_details')->update(['flag' => '']);
//        $query = DB::table('trips')->update(['flag' => '']);
//        $query = DB::table('vehicles')->update(['flag' => '']);
    }
    
    public function viewDifferences($id)
    {
        $version_id = $this->getCurrentVersion();
        if($version_id==$id)
            $differences = $this->getAllDifferences();
        else
            $differences = $this->getVersionDifferences($id);
        //echo '<pre>';        print_r($differences);die;
        //echo '<pre>';        print_r($differences);die;
        return view('versions.viewdifferences',compact('differences'));
        echo '<pre>';        print_r($differences);die;
    }
    
    public function getAllDifferences()
    {
        $differences = array();
        $rows = DB::table('bus_types')
                    ->where('approval_status', '=', 'p')
                    ->get();
        //echo '<pre>';print_r($rows);die;
        foreach($rows as $row){
            $row->log_tablename = 'bus_type_logs';
            $differences['bus_types'][] = $row;
        }
        $rows = DB::table('concession_fare_slabs')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'concession_fare_slab_logs';
            $differences['concession_fare_slabs'][] = $row;
        }
        $rows = DB::table('concessions')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'concession_logs';
            $differences['concessions'][] = $row;
        }
        $rows = DB::table('crew')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'crew_logs';
            $differences['crew'][] = $row;
       }
        $rows = DB::table('denominations')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'denomination_logs';
            $differences['denominations'][] = $row;
        }
        $rows = DB::table('depots')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'depot_logs';
            $differences['depots'][] = $row;
        }
        $rows = DB::table('duties')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'dutie_logs';
            $differences['duties'][] = $row;
        }
        $rows = DB::table('etm_details')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'etm_detail_logs';
            $differences['etm_details'][] = $row;
        }
        $rows = DB::table('fares')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'fare_logs';
            $differences['fares'][] = $row;
        }
        $rows = DB::table('inspector_remarks')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'inspector_remark_logs';
            $differences['inspector_remarks'][] = $row;
        }
        $rows = DB::table('pass_types')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'pass_type_logs';
            $differences['pass_types'][] = $row;
        }
        $rows = DB::table('payout_reasons')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'payout_reason_logs';
            $differences['payout_reasons'][] = $row;
        }
        $rows = DB::table('route_details')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'route_detail_logs';
            $differences['route_details'][] = $row;
        }
        $rows = DB::table('routes')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'route_logs';
            $differences['routes'][] = $row;
        }
        $rows = DB::table('route_master')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'route_master_logs';
            $differences['route_master'][] = $row;
        }
        $rows = DB::table('services')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'service_logs';
            $differences['services'][] = $row;
        }
        $rows = DB::table('shifts')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'shift_logs';
            $differences['shifts'][] = $row;
        }
        $rows = DB::table('stops')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'stop_logs';
            $differences['stops'][] = $row;
        }
        $rows = DB::table('targets')
                   ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'target_logs';
            $differences['targets'][] = $row;
        }
        $rows = DB::table('trip_cancellation_reasons')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'trip_cancellation_reason_logs';
            $differences['trip_cancellation_reasons'][] = $row;
        }
        $rows = DB::table('trip_details')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'trip_detail_logs';
            $differences['trip_details'][] = $row;
        }
        $rows = DB::table('trips')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'trip_logs';
            $differences['trips'][] = $row;
        }
        $rows = DB::table('vehicles')
                    ->where('approval_status', '=', 'p')
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'vehicle_logs';
            $differences['vehicles'][] = $row;
        }
        return $differences;
    }
    
    public function getVersionDifferences($id)
    {
        $differences = array();
        $rows = DB::table('bus_types')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->where('approval_status', '=', 'p')
                    ->get();
        //echo '<pre>';print_r($rows);die;
        foreach($rows as $row){
            $row->log_tablename = 'bus_type_logs';
            $differences['bus_types'][] = $row;
        }
        $rows = DB::table('concession_fare_slabs')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'concession_fare_slab_logs';
            $differences['concession_fare_slabs'][] = $row;
        }
        $rows = DB::table('concessions')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'concession_logs';
            $differences['concessions'][] = $row;
        }
        $rows = DB::table('crew')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'crew_logs';
            $differences['crew'][] = $row;
       }
        $rows = DB::table('denominations')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'denomination_logs';
            $differences['denominations'][] = $row;
        }
        $rows = DB::table('depots')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'depot_logs';
            $differences['depots'][] = $row;
        }
        $rows = DB::table('duties')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'dutie_logs';
            $differences['duties'][] = $row;
        }
        $rows = DB::table('etm_details')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'etm_detail_logs';
            $differences['etm_details'][] = $row;
        }
        $rows = DB::table('fares')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'fare_logs';
            $differences['fares'][] = $row;
        }
        $rows = DB::table('inspector_remarks')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'inspector_remark_logs';
            $differences['inspector_remarks'][] = $row;
        }
        $rows = DB::table('pass_types')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'pass_type_logs';
            $differences['pass_types'][] = $row;
        }
        $rows = DB::table('payout_reasons')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'payout_reason_logs';
            $differences['payout_reasons'][] = $row;
        }
        $rows = DB::table('route_details')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'route_detail_logs';
            $differences['route_details'][] = $row;
        }
        $rows = DB::table('routes')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'route_logs';
            $differences['routes'][] = $row;
        }
        $rows = DB::table('route_master')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'route_master_logs';
            $differences['route_master'][] = $row;
        }
        $rows = DB::table('services')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'service_logs';
            $differences['services'][] = $row;
        }
        $rows = DB::table('shifts')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'shift_logs';
            $differences['shifts'][] = $row;
        }
        $rows = DB::table('stops')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'stop_logs';
            $differences['stops'][] = $row;
        }
        $rows = DB::table('targets')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'target_logs';
            $differences['targets'][] = $row;
        }
        $rows = DB::table('trip_cancellation_reasons')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'trip_cancellation_reason_logs';
            $differences['trip_cancellation_reasons'][] = $row;
        }
        $rows = DB::table('trip_details')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'trip_detail_logs';
            $differences['trip_details'][] = $row;
        }
        $rows = DB::table('trips')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'trip_logs';
            $differences['trips'][] = $row;
        }
        $rows = DB::table('vehicles')
                    ->where(function($query){
                        $query->where('flag', '=', 'a')
                        ->orwhere('flag', '=', 'u')
                        ->orwhere('flag', '=', 'd');
                    })
                    ->get();
        foreach($rows as $key=>$row){
            $row->log_tablename = 'vehicle_logs';
            $differences['vehicles'][] = $row;
        }
        return $differences;
    }
    public function approveChange(Request $request) {
        //echo '<pre>';print_r($request->all());die;
         if(!$this->checkActionPermission('versions','view'))
            return redirect()->route('401');
        //$service = Service::find($id);
        return $query = DB::table($request->table)
                        ->where('id','=',$request->id)
                        ->update(['approval_status' => 'a']);
    }
    
    public function denyChange(Request $request) {
        //echo '<pre>';print_r($request->all());die;
         if(!$this->checkActionPermission('versions','view'))
            return redirect()->route('401');
        //$service = Service::find($id);
        return $query = DB::table($request->table)
                        ->where('id','=',$request->id)
                        ->update(['approval_status' => 'a']);
    }
}