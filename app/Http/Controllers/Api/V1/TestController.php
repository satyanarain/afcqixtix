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

        /*print_r($_FILES);
        return;*/
        /*$validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);*/

        /*if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorData'=>$validator->errors()]);
        }*/

        $user = SitmaticUser::whereId(10)->first();

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

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'errorData'=>$validator->errors()]);
        }

        $user = User::whereId($request->id)->first();

        if(!$user)
        {
            return response()->json(['status'=>'Error', 'errorData'=>'Invalid User ID']);
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

        $img = $_POST['image'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $fileName = uniqid() . '.png';
        $file = public_path('profileImages') .'/'. $fileName;
        $success = file_put_contents($file, $data);

        if($success)
        {
            $user->image = $fileName;
            $user->save();

            $user->image = URL::to('profileImages/'.$user->image);

            return response()->json(['status'=>'Ok', 'successData'=>$user]);
        }
    }
}