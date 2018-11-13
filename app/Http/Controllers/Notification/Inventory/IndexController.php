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
    	$settings = DB::table('inv_notification_centerstock')
    					->select('id', 'item_id', 'min_stock', 'notify_to')
    					->get();
    	foreach ($settings as $key => $value) {
    		$value->item_id = DB::table('inv_items_master')->where('id', $value->item_id)->first()->name;
    		$value->notify_to = DB::table('users')
                ->whereIn('id', json_decode($value->notify_to))
                ->select('email')
                ->get();
    	}

    	//return response()->json($settings);
    	return view('notification.inventory.index', compact('settings'));
    }
}