<?php

namespace App\Repositories\Vehicle;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VehicleCreated;
use App\Traits\activityLog;

class VehicleRepository implements VehicleRepositoryContract {
    use activityLog;
  public function find($id) {
        return Vehicle::join('services', 'users.user_type', '=', 'roles.id')->first();
    }

    public function getAllVehicles() {
        return Vehicle::all();
    }

    public function create($requestData) {
        $input = $requestData->all();
        $input['user_id'] = Auth::id();
        $vehicle = Vehicle::create($input);
        Session::flash('flash_message', "Vehicle Created Successfully."); //Snippet in Master.blade.php
        return $vehicle;
    }

    public function update($id, $requestData) {
        $this->createLog('App\Models\Vehicle', 'App\Models\VehicleLog', $id);
        $vehicle = Vehicle::findorFail($id);
        $input = $requestData->all();
        $input['user_id'] = Auth::id();
        $vehicle_registration_number = $requestData->vehicle_registration_number;
        $sql = Vehicle::where([['vehicle_registration_number', $vehicle_registration_number], ['id', '!=', $id]])->first();
        if (count($sql) > 0) {
            return redirect()->back()->withErrors(['Vehicle registration number has already been taken.']);
        } else {
            $vehicle->fill($input)->save();
            Session::flash('flash_message', "Vehicle Updated Successfully.");
            return $vehicle;
        }
    }

}
