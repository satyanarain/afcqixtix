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





//namespace App\Http\Traits;
//
//use App\Brand;
//
//trait PtestsTrait {
//    public function patentsAll() {
//        // Get all the brands from the Brands Table.
//        $brands = Patent::all();
//
//        return $brands;
//    }
//function DateFormat($date='')
//{
//$newDate = date("d-m-Y", strtotime($date));
//return $newDate;
//}
//public function changeDateFromDMYToYMD($dateToChange="")
//	{
//		if($dateToChange != '')
//        {
//        	$result = date('Y-m-d', strtotime($dateToChange));
//        } else 
//        {
//        	$result = '';            
//        }
//
//        return $result;
//	}
//
//
//}
