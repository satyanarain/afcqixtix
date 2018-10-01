<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'ticket_type' => 'required',
    		'total_amt' => 'required',
    		'abstract_id' => 'required',
    		'trip_id' => 'required',
    		'sold_at' => 'required',
    	]);
    	if($validator->fails())
    	{
            return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
    	}
//        $request->add(['sold_at'=>date('yyyy-mm-dd H:i:s',strtotime($request->sold_at))]);
//        print_r($request->all());
//        die('dfgd');
        
    	$ticket = Ticket::create($request->all());
    	return response()->json(['statusCode'=>'Ok', 'data'=>$ticket]);
    }
}
