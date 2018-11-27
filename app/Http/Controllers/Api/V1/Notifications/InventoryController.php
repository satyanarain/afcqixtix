<?php

namespace App\Http\Controllers\Api\V1\Notifications;

use DB;
use Mail;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\Notifications\Inventory\CenterStock;
use App\Mail\Notifications\Inventory\DepotStock;

/**
 *  
 */
class InventoryController extends Controller
{
	public function index()
	{
		$settingsCenterStock = DB::table('inv_notification_centerstock')
								->select('item_id', 'min_stock', 'notify_to')
								->get();

		$remaningInCenterStock = DB::table('inv_itemsquantity_stock')
									->select(DB::raw("SUM(qty) as item_qty, items_id"))
									->groupBy('items_id')
									->get();

		//return response()->json($settingsCenterStock);

		foreach ($settingsCenterStock as $key => $svalue) 
		{
			foreach ($remaningInCenterStock as $key => $rvalue) 
			{
				if($svalue->item_id == $rvalue->items_id)
				{
					if($rvalue->item_qty <= $svalue->min_stock)
					{
						$notifyTos = User::whereIn('id', json_decode($svalue->notify_to))->select('email', 'name')->get();
						$item = DB::table('inv_items_master')->where('id', $svalue->item_id)->select('name')->first();
						if(count($notifyTos) > 0)
						{
							foreach ($notifyTos as $key => $notifyTo) 
							{
								Mail::to($notifyTo->email)->send(new CenterStock($notifyTo->name, $item->name, $svalue->min_stock, $rvalue->item_qty));
							}
						}
					}
				}
			}
		}


		$settingsDepotStock = DB::table('inv_notification_depotstock')
								->select('item_id', 'min_stock', 'notify_to', 'depot_id')
								->get();

		$remaningInDepotStock = DB::table('inv_centerstock_depotstock')
									->select(DB::raw("SUM(qty) as item_qty, items_id, depot_id"))
									->groupBy('items_id', 'depot_id')
									->get();

		//return response()->json($settingsDepotStock);

		foreach ($settingsDepotStock as $key => $svalue) 
		{
			foreach ($remaningInDepotStock as $key => $rvalue) 
			{
				if($svalue->item_id == $rvalue->items_id && $svalue->depot_id == $rvalue->depot_id)
				{
					if($rvalue->item_qty <= $svalue->min_stock)
					{
						$notifyTos = User::whereIn('id', json_decode($svalue->notify_to))->select('email', 'name')->get();
						$item = DB::table('inv_items_master')->where('id', $svalue->item_id)->select('name')->first();
						$depot = DB::table('depots')->where('id', $svalue->depot_id)->select('name')->first();
						//return response()->json($depot);
						if(count($notifyTos) > 0)
						{
							foreach ($notifyTos as $key => $notifyTo) 
							{
								Mail::to($notifyTo->email)->send(new DepotStock($notifyTo->name, $item->name, $depot->name, $svalue->min_stock, $rvalue->item_qty));
							}
						}
					}
				}
			}
		}

	}
}