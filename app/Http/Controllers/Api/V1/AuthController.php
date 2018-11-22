<?php

namespace App\Http\Controllers\Api\V1;


use JWTAuth;
use Validator;
use App\Models\Crew;
use App\Models\Setting;
use App\Models\ShiftStart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
    	}

    	$crew = Crew::where([['crew_id', $request->username], ['password', $request->password]])->first();

    	if($crew)
    	{
    		$token = JWTAuth::fromUser($crew);

    		//get etm data sync time in seconds form settings
            $sync_time = 120; //default value
            $settings = Setting::where('setting_name', 'ticket_dat')->first();
            if($settings)
            {
                $sync_time = (int)$settings->setting_value;
            }
    		return response()->json(['statusCode'=>'Ok', 'token'=>$token, 'sync_time'=>$sync_time, 'server_year'=>(int)date('Y'), 'server_month'=>(int)date('m'), 'server_date'=>(int)date('d'), 'server_hour'=>(int)date('H'), 'server_minute'=>(int)date('i'), 'server_second'=>(int)date('s'), 'server_day'=>(int)date('w')]);
    	}else{
    		return response()->json(['statusCode'=>'Error', 'data'=>'Invalid credentilas!']);
    	}
    }

    public function logout(Request $request)
    {
        if($request->abstract_no)
        {
            $shift = ShiftStart::where('abstract_no', $abstract_no)->first();
        }        

        if($shift)
        {
            $shift->end_timestamp = date('Y-m-d H:i:s');
            $shift->save();
        }

        JWTAuth::parseToken()->invalidate();
        return response()->json(['statusCode'=>'Ok', 'data'=>'Token destroyed successfully.']);
    }
}
