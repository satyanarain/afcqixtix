<?php

namespace App\Repositories\Inventory\DepotStock;

use DB;
use Notifynder;
use App\Traits\activityLog;
use App\Mail\BusTypeCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Inventory\DepotStock;
use Illuminate\Support\Facades\Session;
use App\Models\Inventory\DepotStockLedger;

class DepotStockRepository implements DepotStockRepositoryContract 
{
    use activityLog;

    public function getAllDepotStock() 
    {
        return DB::table('inv_depot_stock')
                ->select('inv_depot_stock.*','inv_items_master.name','denominations.description', 'depots.name as depot_name')
                ->leftjoin('inv_items_master', 'inv_depot_stock.items_id', '=', 'inv_items_master.id')
                ->leftjoin('denominations', 'inv_depot_stock.denom_id', '=', 'denominations.id')
                ->leftjoin('depots', 'inv_depot_stock.depot_id', '=', 'depots.id')
                ->orderBy('inv_depot_stock.created_at', 'DESC')
                ->get();
    }

    public function create($requestData) 
    { 
        $input = $requestData->all();
        $input['center_head_id'] = Auth::id();

        DB::beginTransaction();
        
        try{            

            if(!checkIfItemHasSeries($requestData->items_id))
            {
                //deduct the inventory from center stock
                $assignedStock = $requestData->quantity;
                if($assignedStock)
                {
                    DB::table('inv_itemsquantity_stock')
                        ->where('items_id', $requestData->items_id)
                        ->decrement('qty', $assignedStock);
                }

                //update the transaction table
                $balance_quantity = 0;
                $transaction = DB::table('inv_centerstock_depotstock')
                                ->where([['items_id', $requestData->items_id], ['depot_id', $requestData->depot_id]])
                                ->first();

                if($transaction)
                {
                    DB::table('inv_centerstock_depotstock')
                        ->where([
                                    ['items_id', $requestData->items_id], 
                                    ['depot_id', $requestData->depot_id]
                                ])
                        ->update(['qty'=>DB::raw("qty + $assignedStock")]);

                    $balance_quantity = $transaction->qty + $assignedStock;

                }else{

                    DB::table('inv_centerstock_depotstock')
                        ->insert([
                                    'items_id' => $requestData->items_id, 
                                    'depot_id'=>$requestData->depot_id, 
                                    'qty'=>$assignedStock
                                ]);

                    $balance_quantity = $assignedStock;
                }
                unset($input['total_tickets']);
                $depostock = DepotStock::create($input);

                //update DepotStockLedger
                DepotStockLedger::create([
                                            'depot_head_id'=>Auth::id(), 
                                            'crew_id'=>null, 
                                            'depot_id'=>$requestData->depot_id, 
                                            'transaction_date'=>date('Y-m-d'), 
                                            'item_id'=>$requestData->items_id, 
                                            'denom_id'=>null, 
                                            'series'=>null, 
                                            'start_sequence'=>null, 
                                            'end_sequence'=>null, 
                                            'item_quantity'=>$assignedStock, 
                                            'challan_no'=>$requestData->challan_no, 
                                            'balance_quantity'=>$balance_quantity, 
                                            'transaction_type'=>'Received'
                                        ]);
            }else{

                $denominations = $requestData->denom_id;
                $serieses = $requestData->series;
                $start_sequences = $requestData->start_sequence;
                $end_sequences = $requestData->end_sequence;
                $total_tickets = $requestData->total_tickets;
                foreach ($denominations as $key => $denomination) 
                { 
                    $input['denom_id'] = $denomination;
                    $input['series'] = $serieses[$key];
                    $input['start_sequence'] = $start_sequences[$key];
                    $input['end_sequence'] = $end_sequences[$key];                
                    $input['quantity'] = $total_tickets[$key];
                    unset($input['total_tickets']);
                    //deduct the inventory from center stock
                    if($input['quantity'])
                    {
                        DB::table('inv_itemsquantity_stock')
                            ->where([
                                        ['items_id', $requestData->items_id], 
                                        ['denom_id', $input['denom_id']], 
                                        ['series', $input['series']]
                                    ])
                            ->decrement('qty', $input['quantity']);
                    }

                    //update the transaction table
                    $balance_quantity = 0;
                    $transaction = DB::table('inv_centerstock_depotstock')
                                    ->where([
                                                ['items_id', $requestData->items_id], 
                                                ['denom_id', $input['denom_id']], 
                                                ['series', $input['series']], 
                                                ['depot_id', $requestData->depot_id]
                                            ])
                                    ->first();

                    if($transaction)
                    {
                        DB::table('inv_centerstock_depotstock')
                            ->where([
                                        ['items_id', $requestData->items_id], 
                                        ['denom_id', $input['denom_id']], 
                                        ['series', $input['series']], 
                                        ['depot_id', $requestData->depot_id]
                                    ])
                            ->update([
                                        'qty'=>DB::raw("qty + $input[quantity]"), 
                                        'end_sequence'=>$input['end_sequence']
                                    ]);

                        $balance_quantity = $transaction->qty + $input['quantity'];

                    }else{

                        DB::table('inv_centerstock_depotstock')
                            ->insert([
                                        'items_id' => $requestData->items_id, 
                                        'denom_id'=> $input['denom_id'], 
                                        'series'=>$input['series'], 
                                        'depot_id'=>$requestData->depot_id, 
                                        'qty'=>$input['quantity'], 
                                        'start_sequence'=>$input['start_sequence'], 
                                        'end_sequence'=>$input['end_sequence']
                                    ]);

                        $balance_quantity = $input['quantity'];
                    }

                    $depostock = DepotStock::create($input);

                    //update DepotStockLedger
                    DepotStockLedger::create([
                                                'depot_head_id'=>Auth::id(), 
                                                'crew_id'=>null, 
                                                'depot_id'=>$requestData->depot_id, 
                                                'transaction_date'=>date('Y-m-d'), 
                                                'item_id'=>$requestData->items_id, 
                                                'denom_id'=>$input['denom_id'], 
                                                'series'=>$input['series'], 
                                                'start_sequence'=>$input['start_sequence'], 
                                                'end_sequence'=>$input['end_sequence'], 
                                                'item_quantity'=>$input['quantity'], 
                                                'challan_no'=>$requestData->challan_no, 
                                                'balance_quantity'=>$balance_quantity, 
                                                'transaction_type'=>'Received'
                                            ]);
                }
            }            

            Session::flash('flash_message', "Stock Created Successfully.");
            DB::commit();
            return $depostock;
        }catch(Illuminate\Database\QueryException $e){
            Session::flash('flash_message', "Error occured while creating stock.");
            DB::roleback();
            return;
        }
    }

    public function update($id, $requestData) 
    {
        $input = $requestData->except(['_method', '_token']);

        try{
            //update center stock
            $stock = DepotStock::whereId($id)->first();
            $assignedStock = $stock->quantity;
            $modifiedStock = $requestData->quantity;
            if($modifiedStock >= $assignedStock)
            {
                $stockDiff = $modifiedStock - $assignedStock;
                DB::table('inv_itemsquantity_stock')->where('items_id', $requestData->items_id)->decrement('qty', $stockDiff);
            }else{            
                $stockDiff = $assignedStock - $modifiedStock;
                DB::table('inv_itemsquantity_stock')->where('items_id', $requestData->items_id)->increment('qty', $stockDiff);
            }

            DepotStock::whereId($id)->update($input);
            
            Session::flash('flash_message', "Stock Updated Successfully.");
            return $depostock;
        }catch(Illuminate\Database\QueryException $e)
        {
            Session::flash('flash_message', "Error occured while updating stock.");
            return;
        }
        
    }


}
