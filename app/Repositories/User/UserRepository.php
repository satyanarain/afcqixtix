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

class UserRepository implements UserRepositoryContract
{

    public function find($id)
    {
    	return User::join('roles', 'users.user_type', '=', 'roles.id')
                    ->leftJoin('clients', 'users.client_id', '=', 'clients.id')
                    ->leftJoin('associates', 'users.associate_id', '=', 'associates.id')
                    ->leftJoin('countries', 'users.bank_country', '=', 'countries.id')
                    ->leftJoin('countries as bfc', 'bfc.id', '=', 'users.beneficiary_country')
                    ->select('bfc.country_name as beneficiary_country_name' ,'users.*', 'roles.display_name', 'associates.name as associate_name', 'clients.client_name as client_name', 'countries.country_name as bank_country')
                    ->where('users.id', $id)
                    ->first();
        //echo json_encode($user);exit();
   
    }

    public function getAllUsers()
    {
        return User::all();
    }
    
    
    public function getAllUsersCount(){
    	return User::where('group_company_id', 'like', '%'.session('companyId').'%')->get()->count();
    }

    public function getAllUsersWithDepartments()
    {
        return  User::select(array('users.name', 'users.id',
                DB::raw('CONCAT(users.name, " (", departments.name, ")") AS full_name')))
        ->join('department_user', 'users.id', '=', 'department_user.user_id')
        ->join('departments', 'department_user.department_id', '=', 'departments.id')
        ->pluck('full_name', 'id');
    }



    public function create($requestData)
    {
        
        
        print_r($_POST);
        
      //  exit();
        
        
        
       $settings = Settings::first();
      $set_password_token = str_random(40);
         $input = $requestData->all();
        $dob = $requestData->dob;
       if($dob!='')
        {
        $input['dob'] = date('Y-m-d', strtotime($dob));
        } else {
        $input['dob']='';
            
        }

        if ($requestData->hasFile('image_path')) {
            if (!is_dir(public_path(). '/images/'. $companyname)) {
                mkdir(public_path(). '/images/'. $companyname, 0777, true);
            }
            $settings = Settings::findOrFail(1);
            $file =  $requestData->file('image_path');

            $destinationPath = public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

            $file->move($destinationPath, $filename);
            
            $input['image_path'] = $filename;
        }

        

        $input['set_password_token'] = $set_password_token;

        if($no_of_companies>0){
            $input['group_company_id'] = $group_company_ids;
        }else{
            $input['group_company_id'] = session('companyId');
        }
        
        //echo json_encode($input);exit();

        $user = User::create($input);
        $user->roles()->attach($role);
        //$user->department()->attach($department);
        $user->save();

        //send notification for profile completion
                Notifynder::category('user.completeprofile')
                ->from(auth()->id())
                ->to($user->id)
                ->url(url('users', $user->id))
                ->expire(Carbon::now()->addDays(30))
                ->send();

        //mail the link to the user for setting the password 
        Mail::to($requestData->email)        
        ->send(new UserCreated($set_password_token));

        Session::flash('flash_message', "$user->name User Created Successfully."); //Snippet in Master.blade.php
        return $user;
    }

    public function update($id, $requestData)
    {   
        /*can not change the status of admin user as pending activation*/
     
        $status = $requestData->status;
        if($status == 0){
            if ($id == 1) {
               return Session()->flash('flash_message_warning', 'Not allowed to change status to "Activation Pending" for super admin');
            }
        }
        //echo json_encode($requestData->all());exit();
        $settings = Settings::first();
        $companyname = $settings->company;
        $user = User::findorFail($id);
        //$password = bcrypt($requestData->password);
        $role = $requestData->user_type;
        //$department = $requestData->departments;
	
	    $group_company_ids = $requestData->group_company_id;
        $no_of_companies = count($group_company_ids);
        if($no_of_companies > 0){
            $group_company_ids = implode(',', $group_company_ids);
        }


        $input = $requestData->all();
       $dob = $requestData->dob;
       if($dob!='')
        {
        $input['dob'] = date('Y-m-d', strtotime($dob));
        } else {
        $input['dob']='';
            
        }
  if ($requestData->hasFile('image_path')) {
            if (!is_dir(public_path(). '/images/'. $companyname)) {
                mkdir(public_path(). '/images/'. $companyname, 0777, true);
            }
            $settings = Settings::findOrFail(1);
            $file =  $requestData->file('image_path');

            $destinationPath = public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

            $file->move($destinationPath, $filename);
            
            $input['image_path'] = $filename;
        }

        if ($requestData->hasFile('business_card')) {
            if (!is_dir(public_path(). '/images/'. $companyname)) {
                mkdir(public_path(). '/images/'. $companyname, 0777, true);
            }
            $settings = Settings::findOrFail(1);
            $file =  $requestData->file('business_card');

            $destinationPath = public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

            $file->move($destinationPath, $filename);
            
            $input['business_card'] = $filename;
        }


        if ($requestData->hasFile('national_id_document')) {
            if (!is_dir(public_path(). '/images/'. $companyname)) {
                mkdir(public_path(). '/images/'. $companyname, 0777, true);
            }
            $settings = Settings::findOrFail(1);
            $file =  $requestData->file('national_id_document');

            $destinationPath = public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

            $file->move($destinationPath, $filename);
            
            $input['national_id_document'] = $filename;
        }

        if ($requestData->hasFile('passport_document')) {
            if (!is_dir(public_path(). '/images/'. $companyname)) {
                mkdir(public_path(). '/images/'. $companyname, 0777, true);
            }
            $settings = Settings::findOrFail(1);
            $file =  $requestData->file('passport_document');

            $destinationPath = public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

            $file->move($destinationPath, $filename);
            
            $input['passport_document'] = $filename;
        }
	
	if($no_of_companies>0){
            $input['group_company_id'] = $group_company_ids;
        }else{
            $input['group_company_id'] = session('companyId');
        }
        //handle the change status 
        /*there are three status 
            Pending Activation->0, for user is created but not activated his account yet 
            Active->1 user has activated his account from link sent to his mail
            and In-active->2 admin has made user status In-active
            now, if admin change the status of user to Activation pending again a reset password link will be sent to users email and his password will be blank status will be 0
            */

        

        if($status == 0){
            $set_password_token = str_random(60);
            //send notification for profile completion
            Notifynder::category('user.completeprofile')
                    ->from(auth()->id())
                    ->to($user->id)
                    ->url(url('users', $user->id))
                    ->expire(Carbon::now()->addDays(30))
                    ->send();

            //mail the link to the user for setting the password 
            Mail::to($requestData->email)        
            ->send(new UserCreated($set_password_token));

            $user->password = "";
            $user->status = 0;
            $user->set_password_token = $set_password_token;
            $user->created_at = Carbon::now();
            $user->save();
        }else{
            $user->fill($input)->save();
            $user->roles()->sync([$role]);
            //$user->department()->sync([$department]);
        }

        Session::flash('flash_message', "$user->name User Updated Successfully.");

        return $user;
    }

    public function destroy($id)
    {
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
