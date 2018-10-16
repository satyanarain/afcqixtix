<?php

namespace App\Repositories\Inventory\CrewStock;

use DB;
use Notifynder;
use App\Models\CrewStock;
use App\Traits\activityLog;
use App\Mail\BusTypeCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
        if($requestData->items_id == 1)
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
                DB::table('inv_centerstock_depotstock')
                    ->where([['depot_id', $requestData->depot_id], ['denom_id', $requestData->denom_id], ['series', $requestData->series], ['items_id', $requestData->items_id]])
                    ->update(['qty' => DB::raw("qty - $qty")]);
                $centerstock = CrewStock::create($input);  


                //update total stock crewwise
                $total = DB::table('inv_crew_total_stock')
                    ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id], ['denom_id', $input['denom_id']], ['series', $input['series']]])
                    ->first();
                if($total)
                {
                    DB::table('inv_crew_total_stock')
                    ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id], ['denom_id', $input['denom_id']], ['series', $input['series']]])
                    ->update(['qty' => DB::raw("qty + $qty")]);
                }else{
                    DB::table('inv_crew_total_stock')
                    ->insert(['items_id' => $requestData->items_id, 'crew_id'=> $requestData->crew_id, 'qty'=>$qty, 'denom_id'=> $input['denom_id'], 'series'=> $input['series']]);
                } 
            }
        } 

        if($requestData->items_id == 2)
        {
            $qty = $requestData->quantity;
            $input['quantity'] = $qty;
            DB::table('inv_centerstock_depotstock')
                ->where([['items_id', $requestData->items_id], ['depot_id', $requestData->depot_id]])
                ->update(['qty' => DB::raw("qty - $qty")]);
            $centerstock = CrewStock::create($input);

            //update total stock crewwise
            $total = DB::table('inv_crew_total_stock')
                ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id]])
                ->first();
            if($total)
            {
                DB::table('inv_crew_total_stock')
                ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id]])
                ->update(['qty' => DB::raw("qty + $qty")]);
            }else{
                DB::table('inv_crew_total_stock')
                ->insert(['items_id' => $requestData->items_id, 'crew_id'=> $requestData->crew_id, 'qty'=>$qty]);
            }
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
