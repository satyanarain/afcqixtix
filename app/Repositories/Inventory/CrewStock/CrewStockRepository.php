<?php

namespace App\Repositories\Inventory\CrewStock;

use DB;
use Notifynder;
use App\Traits\activityLog;
use App\Mail\BusTypeCreated;
use Illuminate\Http\Request;
use App\Models\Inventory\CrewStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Inventory\DepotStockLedger;

class CrewStockRepository implements CrewStockRepositoryContract 
{
    use activityLog;
    public function getAllCrewStock() 
    {
        return DB::table('inv_crew_stock')
                ->select('inv_crew_stock.*','inv_items_master.name','denominations.description','crew.crew_name','depots.name as depot_name')
                ->leftjoin('inv_items_master', 'inv_crew_stock.items_id', '=', 'inv_items_master.id')
                ->leftjoin('denominations', 'inv_crew_stock.denom_id', '=', 'denominations.id')
                ->leftjoin('crew', 'inv_crew_stock.crew_id', '=', 'crew.id')
                ->leftjoin('depots', 'inv_crew_stock.depot_id', '=', 'depots.id')
                ->get();
    }

    public function create($requestData) 
    {      
        $input = $requestData->except(['_token']);
        $input['user_id'] = Auth::id();
        $input['date_received'] = date('Y-m-d H:i:s', strtotime($input['date_received']));
        //update the depot inventory
        if(checkIfItemHasSeries($input['items_id']))
        {
            $denominations = $requestData->denom_id;
            $serieses = $requestData->series;
            $start_sequences = $requestData->start_sequence;
            $end_sequences = $requestData->end_sequence;
            foreach ($denominations as $key => $denomination) 
            { 
                $input['denom_id'] = $denomination;
                $input['series'] = $serieses[$key];
                $input['start_sequence'] = $start_sequences[$key];
                $input['end_sequence'] = $end_sequences[$key];                
                $input['quantity'] = $end_sequences[$key] - $start_sequences[$key] + 1;
                $qty = $input['quantity'];

                $transaction = DB::table('inv_centerstock_depotstock')
                    ->where([['depot_id', $requestData->depot_id], ['denom_id', $requestData->denom_id], ['series', $requestData->series], ['items_id', $requestData->items_id]])
                    ->first();

                if($transaction)
                {
                    DB::table('inv_centerstock_depotstock')
                    ->where([['depot_id', $requestData->depot_id], ['denom_id', $requestData->denom_id], ['series', $requestData->series], ['items_id', $requestData->items_id]])
                    ->update(['qty' => DB::raw("qty - $qty")]);
                    $balance_quantity = $transaction->qty - $qty;
                }else {
                    $balance_quantity = $qty;
                }

                DB::transaction(function() use($input, $requestData, $qty, $balance_quantity) {  
                    $centerstock = CrewStock::create($input); 

                    //update DepotStockLedger 
                    DepotStockLedger::create(['depot_head_id'=>Auth::id(), 'crew_id'=>$requestData->crew_id, 'depot_id'=>$requestData->depot_id, 'transaction_date'=>date('Y-m-d'), 'item_id'=>$requestData->items_id, 'denom_id'=>$input['denom_id'], 'series'=>$input['series'], 'start_sequence'=>$input['start_sequence'], 'end_sequence'=>$input['end_sequence'], 'item_quantity'=>$qty, 'challan_no'=>$requestData->challan_no, 'balance_quantity'=>$balance_quantity, 'transaction_type'=>'Issued']);

                    //update total stock crewwise
                    $total = DB::table('inv_crew_total_stock')
                        ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id], ['denom_id', $input['denom_id']], ['series', $input['series']], ['start_sequence', $input['start_sequence']], ['end_sequence', $input['end_sequence']]])
                        ->first();
                    if($total)
                    {
                        $qt = $total->qty + $qty;
                        DB::table('inv_crew_total_stock')
                        ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id], ['denom_id', $input['denom_id']], ['series', $input['series']]])
                        ->update(['qty' => $qt, 'start_sequence'=>$input['start_sequence'], 'end_sequence'=>$input['end_sequence']]);
                    }else{
                        DB::table('inv_crew_total_stock')
                        ->insert(['items_id' => $requestData->items_id, 'crew_id'=> $requestData->crew_id, 'qty'=>$qty, 'denom_id'=> $input['denom_id'], 'series'=> $input['series'], 'start_sequence'=>$input['start_sequence'], 'end_sequence'=>$input['end_sequence']]);
                    } 
                });
            }
        }else{
            $qty = $requestData->quantity;
            $input['quantity'] = $qty;
            $transaction = DB::table('inv_centerstock_depotstock')
                ->where([['items_id', $requestData->items_id], ['depot_id', $requestData->depot_id]])
                ->first();
            if($transaction)
            {
                $transaction = DB::table('inv_centerstock_depotstock')
                    ->where([['items_id', $requestData->items_id], ['depot_id', $requestData->depot_id]])
                    ->update(['qty' => DB::raw("qty - $qty")]);
                $balance_quantity = $transaction->qty - $qty;
            }else{
                $balance_quantity = $qty;
            }

            DB::transaction(function() use($input, $requestData, $qty, $balance_quantity) {  
                $centerstock = CrewStock::create($input);

                //update DepotStockLedger
                DepotStockLedger::create(['depot_head_id'=>Auth::id(), 'crew_id'=>null, 'depot_id'=>$requestData->depot_id, 'transaction_date'=>date('Y-m-d'), 'item_id'=>$requestData->items_id, 'denom_id'=>null, 'series'=>null, 'start_sequence'=>null, 'end_sequence'=>null, 'item_quantity'=>$qty, 'challan_no'=>$requestData->challan_no, 'balance_quantity'=>$balance_quantity, 'transaction_type'=>'Issued']);

                //update total stock crewwise
                $total = DB::table('inv_crew_total_stock')
                    ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id]])
                    ->first();
                if($total)
                {
                    $qt = $total->qty + $qty;
                    DB::table('inv_crew_total_stock')
                    ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id]])
                    ->update(['qty' => $qt]);
                }else{
                    DB::table('inv_crew_total_stock')
                    ->insert(['items_id' => $requestData->items_id, 'crew_id'=> $requestData->crew_id, 'qty'=>$qty]);
                }
            });
        } 

        
        Session::flash('flash_message', "Stock Created Successfully."); //Snippet in Master.blade.php
        return $centerstock;
    }

    public function update($id, $requestData) 
    {
        $input = $requestData->except(['_method', '_token']);
        $input['user_id'] = Auth::id();
        $input['date_received'] = date('Y-m-d H:i:s', strtotime($input['date_received']));
        $centerstock = CrewStock::whereId($id)->first();
        if($centerstock)
        {
            CrewStock::whereId($id)->update($input);
        }
        Session::flash('flash_message', "Stock Updated Successfully."); //Snippet in Master.blade.php
        return $centerstock;     
    }


}
