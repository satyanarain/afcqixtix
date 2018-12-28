<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\Waybill;
use Illuminate\Http\Request;
use App\Models\TripCancellation;
use App\Http\Controllers\Controller;

class TripCancellationController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'data' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['statusCode'=>'Error', 'errorCode'=>'VALIDATION', 'data'=>$validator->errors()]);
        }

        $jsonDecoded = json_decode($request->data, true);

        $insertedData = [];

        foreach ($jsonDecoded as $key => $value) 
        {
            try{
                //check if abstract number is available in waybills
                $waybill = Waybill::where('abstract_no', $value['abstract_no'])
                                    ->whereDate('date', date('Y-m-d', strtotime($value['cancellation_timestamp'])))
                                    ->first();
                if($waybill)
                {
                    $tripStart = TripCancellation::create(['abstract_no'=>$value['abstract_no'], 'trip_no'=>$value['trip_no'], 'reason_id'=>$value['reason_id'], 'cancellation_timestamp'=>$value['cancellation_timestamp'], 'stop_id'=>$value['stop_id']]);

                    $insertedData[] = ['id'=>$value['local_id'], 'status'=>1];

                }else{
                    $insertedData[] = ['id'=>$value['local_id'], 'status'=>0];
                }
            } catch (\Illuminate\Database\QueryException $exception) {
                $insertedData[] = ['id'=>$value['local_id'], 'status'=>0];
            }            
        }

        return response()->json(['statusCode'=>'Ok', 'data'=>$insertedData]);
    }
}