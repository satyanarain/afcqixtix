<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\TripStart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TripStartController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'service_id' => 'required',
    		'route_id' => 'required',
    		'direction' => 'required',
    		'start_stop_id' => 'required',
    		'end_stop_id' => 'required',
    		'start_timestamp' => 'required',
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
    	}

    	$tripStart = TripStart::create($request->all());

    	return response()->json(['statusCode'=>'Ok', 'trip_id'=>$tripStart->id]);
    }
}
