<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function getSqliteDbName()
    {
    	$fileName = @DB::table('sqlite_db_name')->orderBy('id','desc')->first()->name;

    	if($fileName)
    	{
    		return response()->json(['status'=>'Ok', 'fileName'=>$fileName]);
    	}else {
    		return response()->json(['status'=>'Error', 'fileName'=>'']);
    	}

    }
}
