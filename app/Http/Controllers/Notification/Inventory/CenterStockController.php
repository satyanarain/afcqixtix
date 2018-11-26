<?php

namespace App\Http\Controllers\Notification\Inventory;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CenterStockController extends Controller
{
    public function index()
    {
    	$centerStockSettings = DB::table('inv_notification_centerstock')
    					->select('id', 'item_id', 'min_stock', 'notify_to')
    					->get();
    	foreach ($centerStockSettings as $key => $value) 
        {
    		$value->item_id = DB::table('inv_items_master')->where('id', $value->item_id)->first()->name;
    		$value->notify_to = DB::table('users')
                ->whereIn('id', json_decode($value->notify_to))
                ->select('email')
                ->get();
    	}

        $depotStockSettings = DB::table('inv_notification_depotstock')
                        ->select('id', 'depot_id', 'item_id', 'min_stock', 'notify_to')
                        ->get();

        foreach ($depotStockSettings as $key => $value) 
        {
            $value->item_id = DB::table('inv_items_master')->where('id', $value->item_id)->first()->name;
            $value->depot_id = DB::table('depots')->where('id', $value->depot_id)->first()->name;
            $value->notify_to = DB::table('users')
                ->whereIn('id', json_decode($value->notify_to))
                ->select('email')
                ->get();
        }

    	//return response()->json($settings);
    	return view('notification.inventory.index', compact('centerStockSettings', 'depotStockSettings'));
    }

    /*--------------------------------------------------------------
	*returns the json array of inventory items and admins
    *---------------------------------------------------------------
    */
    public function getItemsandAdmins()
    {
    	$items = DB::table('inv_items_master')
    				->select('name', 'id')
    				->orderBy('name', 'asc')
    				->get();

    	$admins = DB::table('users')
    				->select('name', 'id')
    				->orderBy('name', 'asc')
    				->get();

        $depots = DB::table('depots')
                    ->select('name', 'id')
                    ->orderBy('name', 'asc')
                    ->get();

    	return response()->json(['items'=>$items, 'admins'=>$admins, 'depots'=>$depots]);
    }

    /*----------------------------------------------------------------
    *@param Request
    *
    *@return newly created setting
    *-----------------------------------------------------------------
    */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'item' => 'required',
    		'minlevel' => 'required',
    		'notifyto'=> 'required'
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['status'=>'Error', 'data'=>$validator->errors()]);
    	}

        $notification = DB::table('inv_notification_centerstock')->where('item_id', $request->item)->first();

        if($notification)
        {
            return response()->json(['status'=>'Error', 'errorCode'=>'ALREADY_ADDED', 'data'=>$validator->errors()]);
        }

    	try{
    		$notification = DB::table('inv_notification_centerstock')->insert(['item_id'=>$request->item, 'min_stock'=>$request->minlevel, 'notify_to'=>json_encode($request->notifyto)]);
    	}catch(Illuminate\Database\QueryException $e){
    		return response()->json(['status'=>'Error', 'data'=>$e]);
    	}catch(PDOException $e){
    		return response()->json(['status'=>'Error', 'data'=>$e]);
    	}    	

    	return response()->json(['status'=>'Ok', 'data'=>$notification]);
    }

    /*
    *-------------------------------------------------------------------
    *@param $id
    *@return settings corresponding to id
    *-------------------------------------------------------------------
    */

    public function edit($id)
    {
        $items = DB::table('inv_items_master')
                    ->select('name', 'id')
                    ->orderBy('name', 'asc')
                    ->get();

        $admins = DB::table('users')
                    ->select('name', 'id')
                    ->orderBy('name', 'asc')
                    ->get();

        $settings = DB::table('inv_notification_centerstock')->where('id', $id)->first();

        $selectedOptions = json_decode($settings->notify_to);

        return response()->json(['status'=>'Ok', 'settings'=>$settings, 'items'=>$items, 'admins'=>$admins, 'selectedOptions'=>$selectedOptions]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'minlevel' => 'required',
            'notifyto'=> 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'Error', 'data'=>$validator->errors()]);
        }

        $settings = DB::table('inv_notification_centerstock')->where('id', $id)->first();

        if($settings)
        {
            DB::table('inv_notification_centerstock')
                ->where('id', $id)
                ->update(['min_stock'=>$request->minlevel, 'notify_to'=>json_encode($request->notifyto)]);

            return response()->json(['status'=>'Ok', 'data'=>$settings]);
        }else {
            return response()->json(['status'=>'Error', 'data'=>'Invalid id']);
        }
    }
}