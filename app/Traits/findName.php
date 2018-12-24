<?php

namespace App\Traits;

trait findName {

	function findNameById($table='',$fieldname='',$id='')
	{
	  $name = DB::table('depots')->select('id',$fieldname)->first($depot_id);
         echo  $name = $name->$fieldname;
	 return $name;
	}
	
}

