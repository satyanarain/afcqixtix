<?php
error_reporting(1);
echo '<pre>';
$vals=array();

$pdoMy=new PDO('mysql:dbname=afcqixtix','root','') or die("can't connect to $myDb");
$pdoLi=new PDO('sqlite:data.sqlite') or die("can't connect to $liDb");

$tbls=array('bus_types','concessions','concession_fare_slabs','concession_masters','concession_provider_masters',
            'countries','crew','denominations','depots','duties','fares','inspector_remarks',
            'pass_types','pass_type_masters','payout_reasons','routes','route_details','services','shifts',
            'stops','targets','trips','trip_cancellation_reasons','trip_cancellation_reason_category_masters',
            'trip_details','trip_start','vehicles');
#Delete Old Table
//$deleted_extra_arr = array('ETM_detail_logs','etm_details','abstractbills','bus_type_logs','concession_fare_slab_logs','concession_logs','concession_masters','concession_provider_masters','crew_detail_logs','denomination_logs','denomination_masters','departments','depot_logs','depots111','depots1111','dutie_logs','etm_hot_key_masters','etm_status_masters','fare_logs','fares_copy','inspector_remark_logs','migrations','pass_type_logs','pass_type_masters','password_resets','payout_reason_logs','permission_details','permission_modules','permissions','roles','route_logs','service_logs','settings','shift_logs','stop_logs','target_logs','trip_cancellation_reason_logs','trip_logs','users','vehicle_logs');
foreach ($tbls as $table)
{
    //$result = $db->query('delete from '.$table);
    $result = $pdoLi->query('drop table '.$table);
}
#Create Table
foreach($tbls as $tbl){
	echo "creating table '$tbl'\n";
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
	query("CREATE TABLE IF NOT EXISTS $tbl(\n".implode(",\n",$cols)."\n);\n",$pdoLi);
}



#Insert Rows
foreach($tbls as $tbl){
	echo "inserting data into '$tbl'\n";
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
			query($qs,$pdoLi);
			$qs=array();
			$i=0;
		}
	}
	query($qs,$pdoLi);
}



function query($qs,$pdo){
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
