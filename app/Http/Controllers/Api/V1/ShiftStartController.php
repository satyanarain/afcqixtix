<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\ShiftStart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShiftStartController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'conductor_id' => 'required',
    		'vehicle_id' => 'required',
    		'route_id' => 'required',
    		'driver_id' => 'required',
    		'duty_id' => 'required',
    		'shift_id' => 'required',
    		'odo_reading' => 'required',
    		'start_timestamp' => 'required',
            'abstract_no' => 'required'
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
    	}

    	$shiftStart = ShiftStart::create($request->all());

    	return response()->json(['statusCode'=>'Ok', 'data'=>$shiftStart]);
    }
}
