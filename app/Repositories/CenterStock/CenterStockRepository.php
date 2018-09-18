<?php

namespace App\Repositories\CenterStock;

use Notifynder;
use App\Models\CenterStock;
use App\Mail\BusTypeCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Traits\activityLog;
class CenterStockRepository implements CenterStockRepositoryContract {
    use activityLog;
    public function getAllCenterStock() {
        return BusType::all();
    }

    public function create($requestData) {
        
        $input = $requestData->all();
        $input['user_id'] = Auth::id();
        $bustype = BusType::create($input);
        Session::flash('flash_message', "$bustype->bus_type Bus Type Created Successfully."); //Snippet in Master.blade.php
        return $bustype;
    }

    public function update($id, $requestData) {
       //$this->createLog('App\Models\BusType','App\Models\BusTypeLog',$id);
       $bustype = BusType::findorFail($id);
       $input = $requestData->all();
       $input['user_id'] = Auth::id();
       $bustype->fill($input)->save();
       Session::flash('flash_message', "$bustype->bus_type Bus Type Updated Successfully.");
       return $bustype;
     
    }


}
