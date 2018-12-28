<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\Waybill;
use Illuminate\Http\Request;
use App\Models\TripCancellation;
use App\Http\Controllers\Controller;

class TripCancellationController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'cancellation_timestamp' => 'required',
            'abstract_no' => 'required',
            'trip_no' => 'required',
            'reason_id' => 'required'
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['statusCode'=>'Error', 'errorCode'=>'VALIDATION', 'data'=>$validator->errors()]);
    	}

    	//check if abstract number is available in waybills

    	$waybill = Waybill::where('abstract_no', $request->abstract_no)
    						->whereDate('date', date('Y-m-d', strtotime($request->cancellation_timestamp)))
    						->first();
    	if($waybill)
    	{
    		$tripStart = TripCancellation::create(['abstract_no'=>$request->abstract_no, 'trip_no'=>$request->trip_no, 'reason_id'=>$request->reason_id, 'cancellation_timestamp'=>$request->cancellation_timestamp]);

    		return response()->json(['statusCode'=>'Ok', 'data'=>'Trip Cancelled Successfully.']);
    	}else{
    		return response()->json(['statusCode'=>'Error', 'errorCode'=>'INVALID_ABSTRACT', 'data'=>'Invalid abstract number.']);
    	}
    }
}
