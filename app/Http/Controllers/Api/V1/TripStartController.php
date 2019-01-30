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
            'route_master_id' => 'required',
    		'direction' => 'required',
    		'start_stop_id' => 'required',
    		'end_stop_id' => 'required',
    		'start_timestamp' => 'required',
            'bus_type' => 'required',
            'abstract_no' => 'required',
            'trip_id' => 'required'
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
    	}

    	$tripStart = TripStart::create($request->all());

    	return response()->json(['statusCode'=>'Ok', 'trip_id'=>$tripStart->id]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'end_timestamp' => 'required',
            'abstract_no' => 'required',
            'trip_id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
        }

        $tripStart = TripStart::where([['abstract_no', $request->abstract_no], ['trip_id', $request->trip_id]])->first();

        if($tripStart)
        {
            $tripStart->end_timestamp = date('Y-m-d H:i:s', strtotime($request->end_timestamp));
            $tripStart->save();
        }else{
            return response()->json(['statusCode'=>'Error', 'data'=>'Invalid abstract number or trip number.']);
        }

        return response()->json(['statusCode'=>'Ok', 'trip_id'=>$tripStart->id]);
    }
}
