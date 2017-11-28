<?php
namespace App\Repositories\Vendor;

use App\Models\Vendor;
use App\Models\Address;
use App\Models\Tasks;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Gate;
use Datatables;
use Carbon;
use PHPZen\LaravelRbac\Traits\Rbac;
use App\Models\Role;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Models\Department;
use App\Models\Vendors_Address;
use App\Models\Country;



class VendorRepository implements VendorRepositoryContract
{
    public function allvendors()
    {
        return Vendor::all();
    }
    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function getAllVendorsCount()
    {
        return Vendor::all()->count();
    }
    public function listallcountries()
    {
        return Country::pluck('country_name');

    }
    public function create($requestData)
    {   
        
        
        
        $settings = Settings::first();
       /* $password =  bcrypt($requestData->password);
        $role = $requestData->roles;
        $department = $requestData->departments;*/

        $companyname = $settings->company;
        $country = $requestData->country;
   
        
         $country=implode(',', $country);
        
     
        
        if ($requestData->hasFile('image')) {
                          
            if (!is_dir(public_path(). '/images/'. $companyname)) {
                mkdir(public_path(). '/images/'. $companyname, 0777, true);
            }

            $settings = Settings::findOrFail(1);
            $file =  $requestData->file('image');
            $destinationPath = public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

            $file->move($destinationPath, $filename);
            
            $input =  array_replace($requestData->all(), ['image'=>"$filename",'country'=>$country]);
        } else {
            $input =  array_replace($requestData->all(),['country'=>$country]);
        }

        $vendor = Vendor::create($input);
        $vendor->save();

        
        
        $address = $requestData->address;
        $vendor_id=DB::table('vendors')->max('id');

        foreach($address as $value) 
        {
         Vendors_Address::create(['vendor_id'=>$vendor_id,
         'address'=>$value]);   
        }
        Session::flash('flash_message', 'Vendor successfully added!'); //Snippet in Master.blade.php
        return $vendor;
       }
       
    public function update($id, $requestData)
    {   

        $settings = Settings::first();
        $companyname = $settings->company;
        $address1= $requestData->address;
      $country = $requestData->country;
     
        
       $country=implode(',', $country);
        
 
        
        foreach($address1 as $value1)
      {

    $test=  Vendors_Address::where('vendor_id', '=', $id)
     ->update(['address' =>$value1]);
       

//DB::table('users')->whereIn('id', $array_of_ids)->update(array('votes' => 1));
/* DB::table('vendors_addresses')->where('vendor_id', $id)->update(array('address' => $key));
*/} 
   //print_r($address);


     
           if ($requestData->hasFile('image')) {
                          
           if (!is_dir(public_path(). '/images/'. $companyname)) {
                mkdir(public_path(). '/images/'. $companyname, 0777, true);
            }
            
           
            $settings = Settings::findOrFail(1);
            $file =  $requestData->file('image');
            $destinationPath = public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;
        
            $file->move($destinationPath, $filename);
                   
           $input =  array_replace($requestData->all(), ['image'=>"$filename",'country'=>$country]);
       //     var_dump($input);die();
        } else {
            $input =  array_replace($requestData->all(),['country'=>$country]);
        }

        
       $vendor = Vendor::findOrFail($id);
        $vendor->fill($input)->save();
 
        return $vendor;


    /*
        echo $id;die();
        var_dump($requestData->all());die();
    $settings = Settings::first();
     $companyname = $settings->company;
  
$addarray=$requestData->address;
print_r($addarray);
exit();


foreach($addarray as $value)
{

$update=Address::where('vendor_id','=',$id)
->update(['address'=>$value]);*/
}
/*        $settings = Settings::first();
        $companyname = $settings->company;
        $user = User::findorFail($id);
        $password = bcrypt($requestData->password);
        $role = $requestData->roles;
        $department = $requestData->departments;

        if ($requestData->hasFile('image_path')) {
            $settings = Settings::findOrFail(1);
            $companyname = $settings->company;
            $file =  $requestData->file('image_path');

            $destinationPath = public_path(). '\\images\\'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

            $file->move($destinationPath, $filename);
            if ($requestData->password == "") {
                $input =  array_replace($requestData->except('password'), ['image_path'=>"$filename"]);
            } else {
                $input =  array_replace($requestData->all(), ['image_path'=>"$filename", 'password'=>"$password"]);
            }
        } else {
            if ($requestData->password == "") {
                $input =  array_replace($requestData->except('password'));
            } else {
                $input =  array_replace($requestData->all(), ['password'=>"$password"]);
            }
        }

        $user->fill($input)->save();
        $user->roles()->sync([$role]);
        $user->department()->sync([$department]);

        Session::flash('flash_message', 'User successfully updated!');

        return $user;
*/   
     

    public function destroy($id)
    {
        if ($id == 1)
         {
            return Session()->flash('flash_message_warning', 'Not allowed to delete super admin');
        }
        try 
        {
            $user = User::findorFail($id);
            $user->delete();
            Session()->flash('flash_message', 'User successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'User can NOT have, leads, clients, or tasks assigned when deleted');

    }

    }
   public function status($id)
{
    $status = Vendor::orderBy('id', 'asc')->where('id', $id)
                ->get();
     $statusvalue = $status[0]['status'];

        if($statusvalue==1)
        {
            $value=0;
        } else {
         $value=1;  
        }
     
     $value = Vendor::orderBy('id', 'asc')
                ->where('id', $id)
                ->update(['status' => $value]);
     
     
}
}
