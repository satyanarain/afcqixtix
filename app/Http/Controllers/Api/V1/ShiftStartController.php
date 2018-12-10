<?php

namespace App\Http\Controllers\Api\V1;

use DB;
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
            'abstract_no' => 'required',
            'etm_id' => 'required'
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
    	}

        $input = $request->all();

        unset($input['etm_id']);

    	$shiftStart = ShiftStart::create($input);

        if($shiftStart)
        {
            //update abstract number in etm login log
            DB::table('etm_login_log')
                ->where([['conductor_id', $request->conductor_id], ['etm_id', $request->etm_id]])
                ->whereDate('login_timestamp', DB::raw('CURDATE()'))
                ->update(['abstract_no' => $request->abstract_no]);
            return response()->json(['statusCode'=>'Ok', 'data'=>$shiftStart]);
        }else {
            return response()->json(['statusCode'=>'Error', 'data'=>'Some error occured!']);
        }
    }
}
