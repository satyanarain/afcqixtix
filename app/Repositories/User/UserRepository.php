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
        $input = $requestData->all();
        $date_of_birth = $requestData->date_of_birth;

        if ($date_of_birth!= '') {
            $input['date_of_birth'] = date('Y-m-d', strtotime($date_of_birth));
        } else {
            $input['date_of_birth'] = NULL;
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
//      
//          return User::create([
//        'companyname' => $data['companyname'],
//        'email' => $data['email'],
//        'password' => bcrypt($data['password']),
//        'VAT' => $data['VAT'],
//        'companyphone' => $data['companyphone'],
//        'companystreet' => $data['companystreet'],
//        'companycity' => $data['companycity'],
//        'companycountry' => $data['companycountry'],
//        'companypostcode' => $data['companypostcode']
//        
//    ]);
//    
    Mail::send('newUser', function($message){
        $message->from('info@opiant.online');
        $message->subject('welcome');
        $message->to('satya2000chauhan@gmail.com');
    });
//        
//        
        
        $input['set_password_token'] = $set_password_token;

        $requestData->email="satya2000chauhan@gmail.com";
        
        if($requestData->email!='')
        {
          Mail::send('users.reminder', ['user' => 'qixtix'], function ($m){
          $m->from('info@opiant.online', 'Your Application');
         $m->to($requestData->email, $requestData->name)->subject('User Created!');
         });
        }

        $user = User::create($input);
        Session::flash('flash_message', "$user->name User Created Successfully."); //Snippet in Master.blade.php
        return $user;
    }

    public function update($id, $requestData) {
       $settings = Settings::first();
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
