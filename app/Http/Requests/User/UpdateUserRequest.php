<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('user-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(Request::get('user_type') == 5){
            return [
                'salutation' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                //'email' => 'required|email|unique:users,email',
                'address' => 'required',
                'country' => 'required',
                'contact_number' => 'required|numeric',
                'calling_code_contact' => 'required',
                'city' => 'required',
                'pin' => 'required',
                'date_of_birth' => 'date',
                'user_type' => 'required',
                'client_id' => 'required',
                'associate_id' => 'required'
            ];
        }else if(Request::get('user_type') == 7){
            return [
                'salutation' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                //'email' => 'required|email|unique:users,email',
                'address' => 'required',
                'country' => 'required',
                'contact_number' => 'required|numeric',
                'calling_code_contact' => 'required',
                'city' => 'required',
                'pin' => 'required',
                'date_of_birth' => 'date',
                'user_type' => 'required',
                
                'client_id' => 'required',
            ];
        }else if(Request::get('user_type') == 6){
            return [
                'salutation' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                //'email' => 'required|email|unique:users,email',
                'address' => 'required',
                'country' => 'required',
                'contact_number' => 'required|numeric',
                'calling_code_contact' => 'required',
                'city' => 'required',
                'pin' => 'required',
                'date_of_birth' => 'date',
                'user_type' => 'required',
                
                'associate_id' => 'required'
            ];
        }else if(Request::get('user_type') == 1 || Request::get('user_type') == 9 || Request::get('user_type') == 4){

            if(Request::get('national_id') != ''){
                return [
                    'salutation' => 'required',
                    'name' => 'required',
                    'last_name' => 'required',
                    //'email' => 'required|email|unique:users,email',
                    'address' => 'required',
                    'country' => 'required',
                    'contact_number' => 'required|numeric',
                    'calling_code_contact' => 'required',
                    'city' => 'required',
                    'pin' => 'required',
                    'date_of_birth' => 'date',
                    //'national_id_document' => 'required',
                    'passport_number' => 'required',
                    //'passport_document' => 'required',
                    'user_type' => 'required',
                    'beneficiary_name' => 'required',
                    'beneficiary_address' => 'required',
                	'beneficiary_country' => 'required',
                    //'beneficiary_pin_code' => 'required',
                	'account_type' => 'required',
                	'account_number' => 'required',
                	'swift_code' => 'required',
                    'bank_name' => 'required',
                    //'branch_name' => 'required',
                    'branch_address' => 'required',
                	'bank_country' => 'required',
                    //'bank_pin_code' => 'required',
                ];
            }else{
                return [
                    'salutation' => 'required',
                    'name' => 'required',
                    'last_name' => 'required',
                    //'email' => 'required|email|unique:users,email',
                    'address' => 'required',
                    'country' => 'required',
                    'contact_number' => 'required|numeric',
                    'calling_code_contact' => 'required',
                    'city' => 'required',
                    'pin' => 'required',
                    'date_of_birth' => 'date',
                    'passport_number' => 'required',
                   // 'passport_document' => 'required',
                    'user_type' => 'required',
                    'beneficiary_name' => 'required',
                    'beneficiary_address' => 'required',
                	'beneficiary_country' => 'required',
                    //'beneficiary_pin_code' => 'required',
                    //'bank_name' => 'required',
                    'bank_country' => 'required',
                    //'beneficiary_pin_code' => 'required',
                	'account_type' => 'required',
                	'account_number' => 'required',
                	'swift_code' => 'required',
                	'bank_name' => 'required',
                	//'branch_name' => 'required',
                	'branch_address' => 'required',
                	'bank_country' => 'required',
                	//'bank_pin_code' => 'required',
                ];
        }
         }else{
            return [
                'salutation' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                //'email' => 'required|email|unique:users,email',
                'address' => 'required',                
                'country' => 'required',
                'contact_number' => 'required|numeric',
                'calling_code_contact' => 'required',
                'city' => 'required',
                'pin' => 'required',   
                'date_of_birth' => 'date',            
                'user_type' => 'required',
            ];
        }
        
    }

    public function messages(){
        return [
            'salutation.required' => 'The Salutation field is required.',
            'name.required' => 'The First Name field is required.',
            'last_name.required' => 'The Last Name field is required.',
            'email.required' => 'The Email field is required.',
            'address.required' => 'The Address field is required.',
            'classification.required' => 'The Associate Classification field is required.',
            'email.required' => 'The Email field is required.',
            'contact_number.required' => 'The Contact Number field is required.',
            'calling_code_contact.required' => 'The Contact Number Country Code field is required.',
            'country.required' => 'The Country field is required.',
            'city.required' => 'The City field is required.',
            'pin.required' => 'The Pin field is required.',
            'user_type.required' => 'The User Type field is required.',
            'passport_number.required' => 'The Passport Number field is required.',
            'beneficiary_name.required' => 'The Beneficiary Name field is required.',
            'beneficiary_address.required' => 'The Beneficiary Address field is required.',
            'beneficiary_pin_code.required' => 'The Beneficiary Pin Code field is required.',
            'account_type.required' => 'The Account Type field is required.',
            'account_number.required' => 'The Account Number field is required.',
            'swift_code.required' => 'The SWIFT Code field is required.',
            'bank_name.required' => 'The Bank Branch Details -> Name field is required.',
            'bank_country.required' => 'The Bank Branch Details -> Country field is required.',
            'branch_name.required' => 'The Bank Branch Details -> Branch field is required.',
            'branch_address.required' => 'The Bank Branch Details -> Address field is required.',
            'bank_pin_code.required' => 'The Bank Branch Details -> Pin Code field is required.',
            'associate_id.required' => 'The Select Associate field is required.',
            'client_id.required' => 'The Select Client field is required.',
   
        	'beneficiary_country.required' => 'The Beneficiary Country field is required.',
            'date_of_birth.date' => 'The Date of Birth field must be date'
        ];
    }
}
