<?php

namespace App\Repositories\BusType;
use App\Models\BusType;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Notifynder;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BusTypeCreated;
class BusTypeRepository implements BusTypeRepositoryContract {
    
  public function getAllBusTypes() {
        return BusType::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $bustype = BusType::create($input);
        Session::flash('flash_message', "$bustype->bus_type Bus Type Created Successfully."); //Snippet in Master.blade.php
        return $bustype;
    }

    public function update($id, $requestData) {
       $bustype = BusType::findorFail($id);
       $input = $requestData->all();
       $bustype->fill($input)->save();
       Session::flash('flash_message', "$bustype->bus_type Bus Type Updated Successfully.");
       return $bustype;
    }


}
