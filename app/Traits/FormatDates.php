<?php

namespace App\Traits;

use App\Brand;

trait FormatDates {

	function DateFormat($date='')
	{
		$newDate = date("d-m-Y", strtotime($date));
		return $newDate;
	}
	
	public function changeDateFromDMYToYMD($dateToChange="")
	{
		if($dateToChange != '')
        {
        	$result = date('Y-m-d', strtotime($dateToChange));
        } else 
        {
        	$result = '';            
        }

        return $result;
	}
        
        
        
        
        
	public function insertDate($date='')
	{
        
         	if($date != '')
        {
        	$result = date('Y-m-d', strtotime($date));
        } else 
        {
        	$result =NULL;            
        }

        return $result;
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

