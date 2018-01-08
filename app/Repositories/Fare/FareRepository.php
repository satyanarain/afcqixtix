<?php

namespace App\Repositories\Fare;

use DB;
use Gate;
use Carbon;
use Datatables;
use Notifynder;
use App\Models\Fare;
use App\Models\Role;
use App\Models\User;
use App\Models\Tasks;
use App\Models\Client;
use App\Models\Settings;
use App\Mail\UserCreated;
use App\Models\Department;
use Illuminate\Http\Request;
use PHPZen\LaravelRbac\Traits\Rbac;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class FareRepository implements FareRepositoryContract {

    public function find($id)
    {
        
    }

    public function getAllFares() {
        return Fare::all();
    }

    public function create($requestData) 
    {
        $input = $requestData->all();
        $serviceId = $requestData->service;
        $numberOfUnits = $requestData->number_of_units;
        $stages = $requestData->stage;
        $adultTicketAmounts = $requestData->adult_ticket_amount;
        $childTicketAmounts = $requestData->child_ticket_amount;
        $luggageTicketAmounts = $requestData->luggage_ticket_amount;
        for($i=0; $i<$numberOfUnits; $i++)
        {
            $row['user_id'] = Auth::id();
            $row['stage'] = $stages[$i];
            $row['service_id'] = $serviceId;
            $row['number_of_units'] = $numberOfUnits;
            $row['adult_ticket_amount'] = $adultTicketAmounts[$i];
            $row['child_ticket_amount'] = $childTicketAmounts[$i];
            $row['luggage_ticket_amount'] = $luggageTicketAmounts[$i];

            Fare::create($row);
        }
        return true;
    }

    public function update($id, $requestData) {
       $settings = Settings::first();
       $user = User::findorFail($id);
        $input = $requestData->all();
        $date_of_birth = $requestData->date_of_birth;
        if ($date_of_birth != '') {
            $input['date_of_birth'] = date('Y-m-d', strtotime($date_of_birth));
        } else {
            $input['date_of_birth'] = Null;
        }
         $companyname = "photo";
        if ($requestData->hasFile('image_path')) {
            if (!is_dir(public_path() . '/images/' . $companyname)) {
                mkdir(public_path() . '/images/' . $companyname, 0777, true);
            }
            $settings = Settings::findOrFail(1);
            $file = $requestData->file('image_path');
            $destinationPath = public_path() . '/images/' . $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $input['image_path'] = $filename;
        }
       

            $user->fill($input)->save();
        
        Session::flash('flash_message', "$user->name User Updated Successfully.");

        return $user;
    }

    public function destroy($id) {
        if ($id == 1) {
            return Session()->flash('flash_message_warning', 'Not allowed to delete super admin');
        }
        try {
            $user = User::findorFail($id);
            $user->delete();
            Session()->flash('flash_message', 'User successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'User can NOT have, leads, clients, or tasks assigned when deleted');
        }
    }

}
