<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Tasks;
use App\Models\Settings;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use Notifynder;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use App\Models\PermissionDetail;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Models\Client;
use App\Models\Department;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;

class UserRepository implements UserRepositoryContract {

    public function find($id) {
        return User::join('roles', 'users.user_type', '=', 'roles.id')
                        ->leftJoin('clients', 'users.client_id', '=', 'clients.id')
                        ->leftJoin('associates', 'users.associate_id', '=', 'associates.id')
                        ->leftJoin('countries', 'users.bank_country', '=', 'countries.id')
                        ->leftJoin('countries as bfc', 'bfc.id', '=', 'users.beneficiary_country')
                        ->select('bfc.country_name as beneficiary_country_name', 'users.*', 'roles.display_name', 'associates.name as associate_name', 'clients.client_name as client_name', 'countries.country_name as bank_country')
                        ->where('users.id', $id)
                        ->first();
    }

    public function getAllUsers() {
        return User::all();
    }

    public function getAllUsersCount() {
        return User::where('group_company_id', 'like', '%' . session('companyId') . '%')->get()->count();
    }
  public function getAllUsersWithDepartments() {
        return User::select(array('users.name', 'users.id',
                            DB::raw('CONCAT(users.name, " (", departments.name, ")") AS full_name')))
                        ->join('department_user', 'users.id', '=', 'department_user.user_id')
                        ->join('departments', 'department_user.department_id', '=', 'departments.id')
                        ->pluck('full_name', 'id');
    }

    public function create($requestData) {
        $settings = Settings::first();
        $set_password_token = str_random(40);
        $date_of_birth = $requestData->date_of_birth;
        if ($date_of_birth!= '') {
            $date_of_birth = date('Y-m-d', strtotime($date_of_birth));
        } else {
            $date_of_birth = NULL;
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
         }

        $user = new User;
        $userid = User::create(['name'=>$requestData->name,'user_name'=>$requestData->user_name,'email'=>$requestData->email,'address'=>$requestData->address,
        'country'=>$requestData->country,'city'=>$requestData->city,'password'=>$requestData->password,'mobile'=>$requestData->mobile,'date_of_birth'=>$requestData->date_of_birth,'image_path'=>$filename,'date_of_birth'=>$date_of_birth,'set_password_token'=>$set_password_token,'remember_token'=> $requestData->_token])->id;
         $user = User::findOrFail($userid);
          
/*********************************************************************************************************************/
            $created_by=  Auth::id();
            $input['user_id'] = $userid;
            $input['role_id'] = $requestData->role_id;
            $input['created_by'] = $created_by;
            $input['users'] = implode(',', $requestData->users);
            $input['changepasswords'] = implode(',', $requestData->changepasswords);
            $input['permissions'] = implode(',', $requestData->permissions);
            $input['depots'] = implode(',', $requestData->depots);
            $input['bus_types'] = implode(',', $requestData->bus_types);
            $input['services'] = implode(',', $requestData->services);
            $input['vehicles'] = implode(',', $requestData->vehicles);
            $input['shifts'] = implode(',', $requestData->shifts);
            $input['stops'] = implode(',', $requestData->stops);
            $input['routes'] = implode(',', $requestData->routes);
            $input['duties'] = implode(',', $requestData->duties);
            $input['targets'] = implode(',', $requestData->targets);
            $input['fares'] = implode(',', $requestData->fares);
            $input['concession_fare_slabs'] = implode(',', $requestData->concession_fare_slabs);
            $input['concessions'] = implode(',', $requestData->concessions);
            $input['trip_cancellation_reasons'] = implode(',', $requestData->trip_cancellation_reasons);
            $input['inspector_remarks'] = implode(',', $requestData->inspector_remarks);
            $input['payout_reasons'] = implode(',', $requestData->payout_reasons);
            $input['denominations'] = implode(',', $requestData->denominations);
            $input['pass_types'] = implode(',', $requestData->pass_types);
            $input['crew_details'] = implode(',', $requestData->crew_details);
            $input['ETM_details'] = implode(',', $requestData->ETM_details);
            //echo "<pre>";
           // print_r($input);
            //exit();
            
           $roles= PermissionDetail::create($input);
       //exit();
        /*********************************************************************************************************************/
            if($user->email!='')
        {
       
          Mail::send('users.reminder', ['userid' => $userid,'email'=>$user->email,'username'=>$user->username,'set_password_token'=>$set_password_token], function ($m) use ($user) {
          $m->from('info@opiant.online', 'Your Application');
         $m->to($user->email, $user->name)->subject('User Created!');
         });
        }
          Session::flash('flash_message', "$user->name User Created Successfully."); //Snippet in Master.blade.php
        return $user;
    }

    public function update($id, $requestData) {
        
           $permission = PermissionDetail::findorFail($id);
            $user_id=  Auth::id();
            $input = $requestData->all();
            $created_by=  Auth::id();
            $input['user_id'] = $userid;
            $input['role_id'] = $requestData->role_id;
            $input['created_by'] = $created_by;
            $input['users'] = implode(',', $requestData->users);
            $input['changepasswords'] = implode(',', $requestData->changepasswords);
            $input['permissions'] = implode(',', $requestData->permissions);
            $input['depots'] = implode(',', $requestData->depots);
            $input['bus_types'] = implode(',', $requestData->bus_types);
            $input['services'] = implode(',', $requestData->services);
            $input['vehicles'] = implode(',', $requestData->vehicles);
            $input['shifts'] = implode(',', $requestData->shifts);
            $input['stops'] = implode(',', $requestData->stops);
            $input['routes'] = implode(',', $requestData->routes);
            $input['duties'] = implode(',', $requestData->duties);
            $input['targets'] = implode(',', $requestData->targets);
            $input['fares'] = implode(',', $requestData->fares);
            $input['concession_fare_slabs'] = implode(',', $requestData->concession_fare_slabs);
            $input['concessions'] = implode(',', $requestData->concessions);
            $input['trip_cancellation_reasons'] = implode(',', $requestData->trip_cancellation_reasons);
            $input['inspector_remarks'] = implode(',', $requestData->inspector_remarks);
            $input['payout_reasons'] = implode(',', $requestData->payout_reasons);
            $input['denominations'] = implode(',', $requestData->denominations);
            $input['pass_types'] = implode(',', $requestData->pass_types);
            $input['crew_details'] = implode(',', $requestData->crew_details);
            $input['ETM_details'] = implode(',', $requestData->ETM_details);
            $permission->fill($input)->save();
         
    
       $user = User::findorFail($id);
        $input = $requestData->all();
        $date_of_birth = $requestData->date_of_birth;
        if ($date_of_birth != '') {
            $input['date_of_birth'] = date('Y-m-d', strtotime($date_of_birth));
        } else {
            $input['date_of_birth'] ='';
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
