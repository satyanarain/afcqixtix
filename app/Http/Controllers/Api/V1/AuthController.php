<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use JWTAuth;
use Validator;
use App\Models\Crew;
use App\Models\Setting;
use App\Models\ShiftStart;
use App\Models\ETMLoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'username' => 'required',
    		'password' => 'required',
            'etm_id' => 'required'
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
    	}

    	$crew = Crew::where([['crew_id', $request->username], ['password', $request->password]])->first();

    	if($crew)
    	{
    		$token = JWTAuth::fromUser($crew);

            //update token in database
            Crew::where([['crew_id', $request->username], ['password', $request->password]])->update(['login_jwt'=>$token]);

    		//get etm data sync time in seconds form settings
            $sync_time = 120; //default value
            $settings = Setting::where('setting_name', 'ticket_dat')->first();
            if($settings)
            {
                $sync_time = (int)$settings->setting_value;
            }

            //Update ETM Login Log
            $log = ETMLoginLog::where('conductor_id', $crew->id)
                        ->whereNull('logout_timestamp')
                        ->whereDate('login_timestamp', DB::raw('CURDATE()'))
                        ->count();
            //return response()->json($log);
            if(!$log)
            {
                ETMLoginLog::insert(['conductor_id'=>$crew->id, 'etm_id'=>$request->etm_id, 'login_timestamp'=>date('Y-m-d H:i:s')]);
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

        $conductor = JWTAuth::toUser($token);

        //return response()->json($conductor);

        //Update logout in ETM login log
        ETMLoginLog::where([['conductor_id', $conductor->id], ['logout_timestamp', NULL]])
                    ->whereDate('login_timestamp', DB::raw('CURDATE()'))
                    ->update(['logout_timestamp' => date('Y-m-d H:i:s')]);

        JWTAuth::parseToken()->invalidate();
        return response()->json(['statusCode'=>'Ok', 'data'=>'Token destroyed successfully.']);
    }
}
