<?php

namespace App\Http\Controllers\Api\V1\Notifications;

use DB;
use Mail;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\Notifications\Inventory\CenterStock;

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
					if($rvalue->item_qty < $svalue->min_stock)
					{
						$notifyTos = User::whereIn('id', json_decode($svalue->notify_to))->select('email', 'name')->get();
						$item = DB::table('inv_items_master')->where('id', $svalue->item_id)->select('name')->first();
						if(count($notifyTos) > 0)
						{
							foreach ($notifyTos as $key => $notifyTo) 
							{
								Mail::to($notifyTo->email)->send(new CenterStock($notifyTo->name, $item->name));
							}
						}
					}
				}
			}
		}


		$settingsDepotStock = DB::table('inv_notification_depotstock')
								->select('item_id', 'min_stock', 'notify_to')
								->get();

		$remaningInDepotStock = DB::table('inv_itemsquantity_stock')
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
					if($rvalue->item_qty < $svalue->min_stock)
					{
						$notifyTos = User::whereIn('id', json_decode($svalue->notify_to))->select('email', 'name')->get();
						$item = DB::table('inv_items_master')->where('id', $svalue->item_id)->select('name')->first();
						if(count($notifyTos) > 0)
						{
							foreach ($notifyTos as $key => $notifyTo) 
							{
								Mail::to($notifyTo->email)->send(new CenterStock($notifyTo->name, $item->name));
							}
						}
					}
				}
			}
		}

	}
}