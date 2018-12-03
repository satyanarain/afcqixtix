<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\Waybill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ETMController extends Controller
{
    /**
    *---------------------------------------------------------------------------------------------
    *Update ETM battery and  gprs level
    *@param Request
    *---------------------------------------------------------------------------------------------
    */

    public function updateBatteryAndGPRSLevel(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'gprs_level' => 'required|numeric',
    		'abstract_number' => 'required',
    		'battery_percentage' => 'required|numeric',
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['status'=>'Error', 'data'=>$validator->errors()]);
    	}

    	$waybill = Waybill::where('abstract_no', $request->abstract_number)->first();

    	if($waybill)
    	{
    		$waybill->battery_percentage = $request->battery_percentage;
    		$waybill->gprs_level = $request->gprs_level;
    		$waybill->save();
    		return response()->json(['status'=>'Ok', 'data'=>'GPRS lavel and battery percentage updated successfully.']);
    	}else{
    		return response()->json(['status'=>'Error', 'data'=>'Invalid abstract number!']);
    	}
    }
}
