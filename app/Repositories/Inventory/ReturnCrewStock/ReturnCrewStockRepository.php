<?php

namespace App\Repositories\Inventory\ReturnCrewStock;

use DB;
use Notifynder;
use App\Traits\activityLog;
use App\Mail\BusTypeCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Inventory\ReturnCrewStock;

class ReturnCrewStockRepository implements ReturnCrewStockRepositoryContract 
{
    use activityLog;
    public function getAllReturnCrewStock() 
    {
        return DB::table('inv_returncrew_stock')
                ->select('inv_returncrew_stock.*','inv_items_master.name','denominations.description','crew.crew_name','depots.name as depot_name')
                ->leftjoin('inv_items_master', 'inv_returncrew_stock.items_id', '=', 'inv_items_master.id')
                ->leftjoin('denominations', 'inv_returncrew_stock.denom_id', '=', 'denominations.id')
                ->leftjoin('crew', 'inv_returncrew_stock.crew_id', '=', 'crew.id')
                ->leftjoin('depots', 'inv_returncrew_stock.depot_id', '=', 'depots.id')
                ->get();
    }

    public function create($requestData) 
    {      
        $input = $requestData->except(['_token']);
        $input['returned_to'] = Auth::id();
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
                //update depot stock
                DB::table('inv_centerstock_depotstock')
                    ->where([['depot_id', $requestData->depot_id], ['denom_id', $requestData->denom_id], ['series', $requestData->series], ['items_id', $requestData->items_id]])
                    ->update(['qty' => DB::raw("qty + $qty")]);

                //update crew total stock
                DB::table('inv_crew_total_stock')
                    ->where([['denom_id', $requestData->denom_id], ['series', $requestData->series], ['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id]])
                    ->update(['qty' => DB::raw("qty - $qty")]);
                $centerstock = ReturnCrewStock::create($input);
            }
        } 

        if($requestData->items_id == 2)
        {
            $qty = $requestData->quantity;
            $input['quantity'] = $qty;
            //update depo stock
            DB::table('inv_centerstock_depotstock')
                ->where([['items_id', $requestData->items_id], ['depot_id', $requestData->depot_id]])
                ->update(['qty' => DB::raw("qty + $qty")]);
            //update crew total stock
            DB::table('inv_crew_total_stock')
                ->where([['items_id', $requestData->items_id], ['crew_id', $requestData->crew_id]])
                ->update(['qty' => DB::raw("qty - $qty")]);
            $centerstock = ReturnCrewStock::create($input);
        } 

        
        Session::flash('flash_message', "Stock Created Successfully."); //Snippet in Master.blade.php
        return $centerstock;
    }

    public function update($id, $requestData) 
    {
        $input = $requestData->except(['_method', '_token']);
        $input['user_id'] = Auth::id();
        $input['date_received'] = date('Y-m-d H:i:s', strtotime($input['date_received']));
        $centerstock = ReturnCrewStock::whereId($id)->first();
        if($centerstock)
        {
            ReturnCrewStock::whereId($id)->update($input);
        }
        Session::flash('flash_message', "Stock Updated Successfully."); //Snippet in Master.blade.php
        return $centerstock;     
    }


}
