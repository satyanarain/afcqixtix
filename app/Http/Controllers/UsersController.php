<?php
namespace App\Http\Controllers;

use Gate;
use Carbon;
use Datatables;
use Notifynder;
use DB;
use Excel;
use Schema;
use Response;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests;
use App\Models\Client;
use App\Models\Associate;
use App\Models\Role;
use App\Models\GroupCompany;
use App\Models\CountryCallingCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPZen\LaravelRbac\Traits\Rbac;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserBankDetailRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;

use App\Repositories\Setting\SettingRepositoryContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    protected $users;
    protected $roles;
    protected $departments;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles,
        SettingRepositoryContract $settings
    ) {
        $this->users = $users;
        $this->roles = $roles;
        $this->settings = $settings;
      //  $this->middleware('user.create', ['only' => ['create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
     return view('users.index')->withUsers();
   
    }
    public function create()
    {
    
       $user = User::findOrFail(Auth::id());
        return view('users.create')->withRoles($roles)->withCountries(Country::orderBy('country_name', 'asc')->pluck('country_name', 'id'));
        
    }
 public function getCompaniesUserHasAccessIn(){
        $user = User::findOrFail(Auth::id());
        $company_ids = $user->group_company_id;
        $company_ids = explode(',', $company_ids);

        $companies = GroupCompany::whereIn('id', $company_ids)->get();

        return $companies->toJson();
    }

    public function changeProfileImage(Request $request){
        $data = $request->image; 

        list($type, $data) = explode(';', $data);

        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $file_name = str_random(40).'.jpeg';
        $folder_path = public_path().'/images/Media/'.$file_name;
        file_put_contents($folder_path, $data);

        $user = User::find($request->id);

        $user->image_path = $file_name;
        $user->save();

       return response()->json([
            'status' => 'success',
            'message' => 'Profile picture changed successfully!'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    /**
     * Store a newly created resource in storage.
     * @param User $user
     * @return Response
     */
    public function store(Request $userRequest)
    {
      
        
        
        $getInsertedId = $this->users->create($userRequest);
        
         echo "=======================================" ;
        //exit();
        
        
        // exit();
        return redirect()->route('users.index');         
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   public function show($id)
   {
       

       
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $countries = Country::pluck('country_name', 'id');
       // $clients = Client::where('company_id', '=', session('companyId'))->orderBy('client_name', 'asc')->pluck('client_name', 'id');
        $clients = Client::where([['company_id', '=', session('companyId')]])->orderBy('client_name', 'asc')->pluck('client_name', 'id');
        $associates = Associate::pluck('name', 'id');
        $codes = DB::table('countries_calling_code')->orderBy('country_name', 'desc')->pluck(DB::raw('CONCAT(country_name, " (", calling_code, ") ") AS calling_code_text'), 'calling_code');
        foreach ($codes as $key => $value) {
            $mod[$value] = $key; 
        }
        ksort($mod);
        foreach ($mod as $key => $value) {
            $newmod[$value] = $key; 
        }

       $bankid = DB::table('users')->where('id','=',$id)->first();
      
      $bank_country_id= $bankid->bank_country;
    // echo json_encode($bank_country_id);exit();
        return view('users.edit',compact('bank_country_id',$bank_country_id))
        ->withUser($this->users->find($id))
        ->withRoles($this->roles->listAllRoles())
        ->withClients($clients)

        ->withAssociates($associates)
        ->withCountries($countries)
        ->withGroupCompanies(GroupCompany::where('id', '<>', 99)->pluck('name', 'id'))
        ->withTelephoneCodes($newmod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->users->update($id, $request);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->users->destroy($id);
        
        return redirect()->route('users.index');
    }

    public function createdPassword($token){
        return view('users.activate', ['token' => $token]);
    }
 public function setPassword(Request $request){
        //var_dump($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $check_if_email_is_registered = User::where([
            ['email', '=', $request->email]
        ])->first();

        $validator->after(function($validator) use ($check_if_email_is_registered)
        {
            if (!$check_if_email_is_registered)
            {
                $validator->errors()->add('email_not_registered', 'This email is not registered!');
            }
        });


        if ($validator->fails()) {
            return redirect(route('password.create', $request->token))
                ->withInput()
                ->withErrors($validator);
        }

        $token = User::where([
            ['email', '=', $request->email],
            ['set_password_token','=', $request->token]
           // ['created_at','>',Carbon::now()->subHours(24)]
        ])->first();

        if($token){
            $user = User::find($token->id);
            //set password
            $user->password = bcrypt($request->password);
            //change status
            $user->status = 1;
            $user->save();

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                //echo json_encode($token);exit();
                return redirect('dashboard');
            }
        }else{
            return "Link has been expired. Please contact to admin.";
        }
    }
  public function checkIfEmailIsRegistered(Request $request){
        $check_if_email_is_registered = User::where([
            ['email', '=', $request->email]
        ])->first();
        return $check_if_email_is_registered;
    }

    public function showTravelModal($id, Request $request){
        $userprofile="userprofile";
        return view('modals.create_travel',compact('userprofile'))
        ->withUser(User::findOrFail($id))
        ->withCountries(Country::pluck('country_name', 'id'));
    }

    public function showEditTravelModal($travel_id){
          $userprofile="userprofile";
        $travel = Travel::findOrFail($travel_id);
        return view('modals.edit_travel',compact('userprofile'))
        ->withTravel($travel)
        ->withUser(User::findOrFail(Auth::id()))
        ->withCountries(Country::pluck('country_name', 'id'))
        ->withDocuments(TravelDocument::where('travel_id', '=', $travel_id)->get());
    }

    public function saveTravelDetail($id, StoreTravelRequest $request)
    {    	
        $input = $request->all();
        $input['user_id'] = $id;   
        
        $input['visa_from'] = date('Y-m-d', strtotime($request->visa_from));
        $input['visa_to'] = date('Y-m-d', strtotime($request->visa_to));
        $input['passport_expires_on'] = date('Y-m-d', strtotime($request->passport_expires_on));
        $input['booking_from'] = date('Y-m-d', strtotime($request->booking_from));
        $input['booking_to'] = date('Y-m-d', strtotime($request->booking_to));

        $input['travel_from_date'] = date('Y-m-d', strtotime($request->travel_from_date));
        $input['travel_to_date'] = date('Y-m-d', strtotime($request->travel_to_date));
       $document_types = $request->document_types;
        //echo json_encode($document_types);exit();
        $travel = Travel::create($input);

        if ($request->hasFile('travel_documents')) {

            $documents = $request->file('travel_documents');
            foreach ($documents as $key => $value) {
                $filename = str_random(40).'.'.$value->extension();
                if (!is_dir(public_path(). '/images/Travel')) {
                    mkdir(public_path(). '/images/Travel', 0777, true);
                }
                $path = public_path(). '/images/Travel';
                //echo $path; exit();
                //$file =  $value->file('travel_document');
                $value->move($path, $filename);
                $input_travel['document_path'] = $filename;
                $input_travel['travel_id'] = $travel->id;
                $input_travel['document_type'] = $document_types[$key];

                TravelDocument::create($input_travel);
            }
            
        }  

        //send notification to admin when user travel profile is created
        Notifynder::category('user.travelprofilecreated')
                ->from(auth()->id())
                ->to(1)
                ->url(url('users/'.auth()->id().'/showtravelprofile/'.$travel->id))
                ->expire(Carbon::now()->addDays(30))
                ->send();

        Session()->flash('flash_message', 'Travel profile successfully added.');
        return redirect(route('users.show', $id));
    }


    public function updateTravelDetail($travel_id, UpdateTravelRequest $request){


        $input = $request->all();
        $id = Auth::user()->id;
        $input['user_id'] = $id;
        $travel = Travel::findOrFail($travel_id);
        $input['visa_from'] = date('Y-m-d', strtotime($request->visa_from));
        $input['visa_to'] = date('Y-m-d', strtotime($request->visa_to));
        $input['passport_expires_on'] = date('Y-m-d', strtotime($request->passport_expires_on));
        $input['booking_from'] = date('Y-m-d', strtotime($request->booking_from));
        $input['booking_to'] = date('Y-m-d', strtotime($request->booking_to));

        $input['travel_from_date'] = date('Y-m-d', strtotime($request->travel_from_date));
        $input['travel_to_date'] = date('Y-m-d', strtotime($request->travel_to_date));
        
        $document_types = $request->document_types;
        
        /* foreach ($document_types as $type){
        	$travel_documents = TravelDocument::where([['travel_id', '=', $travel->id], ['document_type', '=', $type]])->delete();
        } */


        if ($request->hasFile('travel_documents')) {

            $documents = $request->file('travel_documents');
            foreach ($documents as $key => $value) {
                $filename = str_random(40).'.'.$value->extension();
                if (!is_dir(public_path(). '/images/Travel')) {
                    mkdir(public_path(). '/images/Travel', 0777, true);
                }
                $path = public_path(). '/images/Travel';
                //echo $path; exit();
                //$file =  $value->file('travel_document');
                $value->move($path, $filename);
                $input_travel['document_path'] = $filename;
                $input_travel['travel_id'] = $travel->id;
                $input_travel['document_type'] = $document_types[$key];

                TravelDocument::create($input_travel);
            }
            
        }       
        
        $travel->fill($input)->save();

        //send notification to admin when user travel profile is updated
        Notifynder::category('user.travelprofileupdated')
                ->from(auth()->id())
                ->to(1)
                ->url(url('users/'.auth()->id().'/showtravelprofile/'.$travel->id))
                ->expire(Carbon::now()->addDays(30))
                ->send();
        
        Session()->flash('flash_message', 'Travel profile successfully updated');
        return redirect(route('users.show', $id));
    }


    public function showTravelDetail($user_id, $travel_id){
        $travel = Travel::join('countries', 'countries.id', '=', 'travel.country')
                    ->select('travel.*', 'countries.country_name as country_travelled')
                    ->where('travel.id', '=', $travel_id)
                    ->first();
        $user = User::findOrFail($user_id);
        $travel_document = TravelDocument::where('travel_id', '=', $travel_id)->get();
        return view('modals.traveldetail')
                ->withTravel($travel)
                ->withUser($user)
                ->withTravelDocuments($travel_document);
    }

    public function editBankDetail($userId){
        $countries = Country::pluck('country_name', 'id');
        return view('modals.edit_bank_detail')
                ->withUser(User::findOrFail(Auth::id()))
                ->withCountries($countries);
    }

    public function updateBankDetail($userId, UpdateUserBankDetailRequest $request){
        $user = User::findOrFail(Auth::id());

        $user->beneficiary_name = $request->beneficiary_name;
        $user->bank_name        = $request->bank_name;
        $user->branch_name      = $request->branch_name;
        $user->branch_address   = $request->branch_address;
        $user->account_type     = $request->account_type;
        $user->account_number   = $request->account_number;
        $user->swift_code       = $request->swift_code;
        $user->ifsc_code        = $request->ifsc_code;
        $user->beneficiary_address = $request->beneficiary_address;
        $user->beneficiary_country = $request->beneficiary_country;
        $user->beneficiary_pin_code = $request->beneficiary_pin_code;
        $user->bank_country = $request->bank_country;
        $user->bank_pin_code = $request->bank_pin_code;
        $user->routing_code = $request->routing_code;

        $user->save();

        Session()->flash('flash_message', 'Bank detail successfully updated');
        return redirect(route('users.show', Auth::id()));
    }
    
    public function changeName(Request $request){
        $user_id = $request->user_id;
        if($user_id == Auth::id()){
            $user = User::findOrFail($request->user_id);
            $user->name = $request->newName;
            $user->save();
            $arr = array('status' => 'Ok', 'newName' => $user->name);
        }else{
            $arr = array('status' => 'Error');
        }

        echo json_encode($arr);
    }

    public function changeContact(Request $request){
        $user_id = $request->user_id;
        if($user_id == Auth::id()){
            $user = User::findOrFail($request->user_id);
            $user->contact_number = $request->newContact;
            $user->save();
            $arr = array('status' => 'Ok', 'newContact' => $user->contact_number);
        }else{
            $arr = array('status' => 'Error');
        }

        echo json_encode($arr);
    }

    public function changeAddress(Request $request){
        $user_id = $request->user_id;
        if($user_id == Auth::id()){
            $user = User::findOrFail($request->user_id);
            $user->address = $request->newAddress;
            $user->save();
            $arr = array('status' => 'Ok', 'newAddress' => $user->address);
        }else{
            $arr = array('status' => 'Error');
        }

        echo json_encode($arr);
    }

    public function deleteTravelDetail($user_id, $travel_id){

        $travel = Travel::findorFail($travel_id);
        $travel->delete();
        Session()->flash('flash_message', 'Travel successfully deleted');        
        
        return redirect()->route('users.show', $user_id);
    }


    public function printTravelDetails($user_id){
        $travels = Travel::join('countries', 'countries.id', '=', 'travel.country')
            ->select('travel.*', 'countries.country_name')
            ->where('user_id', '=', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=travel_details.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        //$reviews = Reviews::getReviewExport($this->hw->healthwatchID)->get();
        $columns = array('Country Travelled', 'Visa Number', 'Visa Valid From', 'Visa Valid Upto', 'Visa Type', 'Travel From Date', 'Travel To Date', 'Travelling Summary', 'Hotel Name', 'Hotel Address', 'Hotel Check-In', 'Hotel Check-Out', 'Passport Number', 'Passport Expires On', 'Note Section', 'Created At');

        $callback = function() use ($travels, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($travels as $travel) {
                fputcsv($file, array($travel->country_name, $travel->visa_number, $travel->visa_from, $travel->visa_to, $travel->visa_type, $travel->travel_from_date, $travel->travel_to_date, $travel->summary, $travel->hotel_name, $travel->hotel_address, $travel->booking_from, $travel->booking_to, $travel->passport_number, $travel->passport_expires_on, $travel->note, $travel->created_at));
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);

    }
    
    
}
