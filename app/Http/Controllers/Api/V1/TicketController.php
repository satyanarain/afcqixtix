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
        
    	$ticket = Ticket::create($request->except(['token']));
    	return response()->json(['statusCode'=>'Ok', 'data'=>$ticket]);
    }

    public function importTickets(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
        }

        $jsonDecoded = json_decode($request->data, true);

        foreach ($jsonDecoded as $key => $value) 
        {
            $ticket = Ticket::create($value);
        }

        return response()->json($jsonDecoded);
    }
}
