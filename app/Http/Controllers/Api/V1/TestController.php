<?php

namespace App\Http\Controllers\Api\V1;

use URL;
use Validator;
use App\Models\SitmaticUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
	public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorData'=>$validator->errors()]);
        }

        $user = SitmaticUser::whereId($request->id)->first();

        if(!$user)
        {
            return response()->json(['status'=>'Error', 'errorData'=>'Invalid User ID']);
        }

        if($request->hasFile('image'))
        {
            if(!is_dir(public_path('profileImages')))
            {
                mkdir(public_path('profileImages'), 0700, true);
            }

            $file = $request->file('image');

            $fileName = str_random(8).'_'.$file->getClientOriginalName(); 

            $file->move(public_path('profileImages'), $fileName);

            $user->image = $fileName;
            $user->save();
        }

        if($request->address)
        {
            $user->address = $request->address;
            $user->save();
        }

        if($request->zipcode)
        {
            $user->zipcode = $request->zipcode;
            $user->save();
        }
        
        $user->image = URL::to('profileImages/'.$user->image);

        return response()->json(['status'=>'Ok', 'successData'=>$user]);
    }
}