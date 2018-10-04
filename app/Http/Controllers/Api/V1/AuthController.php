<?php

namespace App\Http\Controllers\Api\V1;


use JWTAuth;
use Validator;
use App\Models\Crew;
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

    		//return strlen($token);
    		return response()->json(['statusCode'=>'Ok', 'token'=>$token]);
    	}else{
    		return response()->json(['statusCode'=>'Error', 'data'=>'Invalid credentilas!']);
    	}
    }
}
