<?php

namespace App\Traits;
use App\Models\Fare;
use App\Brand;

trait activityLog {

	function createLog($controllerModel='',$controllerModelLog='',$id='')
	{
	$fares_log = $controllerModel::where('id', '=', $id )->get()->toArray();
       unset($fares_log[0]['id']);
     //  unset($fares_log[0]['created_at']);
       unset($fares_log[0]['updated_at']);
       foreach ($fares_log as $item) 
        {
          return  $controllerModelLog::insert($item);
        }
        
	}
        
        function mySqlDate($date='')
	{ 
        if ($date!= '') {
           return date('Y-m-d', strtotime($date));
        } else {
           return NULL;
        
	}
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

