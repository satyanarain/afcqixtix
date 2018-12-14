<?php

namespace App\Http\Controllers\Notification\Inventory;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
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
                ->select('email', 'name')
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
                ->select('email', 'name')
                ->get();
        }

        //return response()->json($settings);
        return view('notification.inventory.index', compact('centerStockSettings', 'depotStockSettings'));
    }
}