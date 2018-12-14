<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InspectionController extends Controller
{
	/**
	*For storing the inspection data in bulk
	*@param Request inspection data
	*@return Response local id with status, 1=>success, 0=>failure
	*/
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'data' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['statusCode'=>'Error', 'data'=>$validator->errors()]);
        }

        $jsonDecoded = json_decode($request->data, true);

        $insertedData = [];

        foreach ($jsonDecoded as $key => $value) 
        {
            try{
                $ticket = Inspection::create($value);
                $insertedData[] = ['id'=>$value['local_id'], 'status'=>1];
            } catch (\Illuminate\Database\QueryException $exception) {
                $insertedData[] = ['id'=>$value['local_id'], 'status'=>0];
            }            
        }

        return response()->json($insertedData);
    }
}
