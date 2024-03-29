<?php

namespace App\Repositories\Inventory\CenterStock;

use DB;
use Notifynder;
use App\Traits\activityLog;
use App\Mail\BusTypeCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Inventory\CenterStock;
use Illuminate\Support\Facades\Session;

class CenterStockRepository implements CenterStockRepositoryContract {
    use activityLog;

    public function getAllCenterStock() 
    {
        return BusType::all();
    }

    public function create($request) 
    {        
        $input = $request->all();

        //upload file if any
        $uploaddirectory = "inventory";
        if ($request->hasFile('fileupload')) 
        {
            if (!is_dir(public_path() . '/images/' . $uploaddirectory)) 
            {
                mkdir(public_path() . '/images/' . $uploaddirectory, 0777, true);
            }
            $file = $request->file('fileupload');

            $destinationPath = public_path() . '/images/' . $uploaddirectory;
            $filename = str_random(8) . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $input['fileupload'] = $filename;
        }

        if(!checkIfItemHasSeries($input['items_id']))
        {
            DB::transaction(function() use($input) {  
                //Update quantity in main table
                $itemsdata = DB::table("inv_itemsquantity_stock")
                                ->where("items_id", "=", $input['items_id'])
                                ->first();

                if(!$itemsdata)
                {
                    DB::table('inv_itemsquantity_stock')
                            ->insert(array('items_id' => $input['items_id'],'qty' => $input['quantity'])); 
                }else{

                    $total = ($itemsdata->qty + $input['quantity']);
                    DB::table('inv_itemsquantity_stock')
                        ->where('items_id', $input['items_id'])
                        ->update(['qty' => $total]);
                }
                $input['series'] = "";
                $input['user_id'] = Auth::id();
                $input['date_received'] = date('Y-m-d H:i:s', strtotime($input['date_received']));
                $centerstock = CenterStock::create($input);
            });

        }else{

            $denominations = $request->denom_id;
            $serieses = $request->series;
            $start_sequences = $request->start_sequence;
            $end_sequences = $request->end_sequence;

            foreach ($denominations as $key => $denomination) 
            { 
                $input['user_id'] = Auth::id();
                $input['date_received'] = date('Y-m-d H:i:s', strtotime($input['date_received']));
                $input['denom_id'] = $denomination;
                $input['series'] = $serieses[$key];
                $input['start_sequence'] = $start_sequences[$key];
                $input['end_sequence'] = $end_sequences[$key];                
                $input['quantity'] = $end_sequences[$key] - $start_sequences[$key] + 1;

                DB::transaction(function() use($input, $key, $denomination) { 

                    $stock = DB::table('inv_itemsquantity_stock')
                                ->where([
                                            ['items_id', $input['items_id']], 
                                            ['denom_id', $denomination], 
                                            ['series', $input['series']]
                                        ])
                                ->first();

                    if($stock)
                    {
                        DB::table('inv_itemsquantity_stock')
                                ->where([
                                            ['items_id', $input['items_id']], 
                                            ['denom_id', $denomination], 
                                            ['series', $input['series']]
                                        ])
                                ->update([
                                            'qty' => DB::raw("qty + $input[quantity]"), 
                                            'end_sequence'=>$input['end_sequence']
                                        ]);
                    }else{
                        DB::table('inv_itemsquantity_stock')
                                ->insert([
                                            'items_id' =>$input['items_id'], 
                                            'qty' => $input['quantity'], 
                                            'series'=>$input['series'], 
                                            'start_sequence'=>$input['start_sequence'], 
                                            'end_sequence'=>$input['end_sequence'], 
                                            'denom_id'=>$denomination
                                        ]); 
                    }

                    $centerstock = CenterStock::create($input);
                });
            }
        }
        
        Session::flash('flash_message', "Stock Created Successfully."); //Snippet in Master.blade.php
        return $centerstock;
    }

    public function update($id, $request) 
    {
        $input = $request->except(['_method', '_token']);
        $input['user_id'] = Auth::id();
        $input['date_received'] = date('Y-m-d H:i:s', strtotime($input['date_received']));
        $centerstock = CenterStock::whereId($id)->first();

        if($request->items_id == 2)
        {
            //Update quantity in main table
            $assignedStock = $centerstock->quantity;
            $modifiedStock = $request->end_sequence - $request->start_sequence + 1;
            $itemsdata = DB::table("inv_itemsquantity_stock")->select('*')->where("items_id", "=", $request->items_id)->first();
            if($modifiedStock >= $assignedStock)
            {
                $stockDiff = $modifiedStock - $assignedStock;
                DB::table('inv_itemsquantity_stock')->where('items_id', $requestData->items_id)->decrement('qty', $stockDiff);
            }else{            
                $stockDiff = $assignedStock - $modifiedStock;
                DB::table('inv_itemsquantity_stock')->where('items_id', $requestData->items_id)->increment('qty', $stockDiff);
            }
        } 
        if($request->items_id == 1)
        {
            $assignedStock = $centerstock->quantity;
            $modifiedStock = $request->end_sequence - $request->start_sequence + 1;

            if($modifiedStock >= $assignedStock)
            {
                $stockDiff = $modifiedStock - $assignedStock;
                DB::table('inv_itemsquantity_stock')->where('items_id', $requestData->items_id)->update(['qty' => $stockDiff, 'end_sequence'=>$request->end_sequence]);
            }else{            
                $stockDiff = $assignedStock - $modifiedStock;
                DB::table('inv_itemsquantity_stock')->where('items_id', $requestData->items_id)->update(['qty' => $stockDiff, 'end_sequence'=>$request->end_sequence]);
            }
        }

        if($centerstock)
        {
            CenterStock::whereId($id)->update($input);
        }
        Session::flash('flash_message', "Stock Updated Successfully."); //Snippet in Master.blade.php
        return $centerstock;
     
    }


}
