<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateUserBankDetailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('user-update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    	return [
    	   'beneficiary_name' => 'required',
           'beneficiary_address' => 'required',
           'beneficiary_country' => 'required',
           'account_type' => 'required',
           'account_number' => 'required',
           'swift_code' => 'required',
           'bank_name' => 'required',
           'branch_address' => 'required',
           'bank_country' => 'required',
		];        
        
    }

    public function messages(){
        return [
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
        	'beneficiary_country.required' => 'The Beneficiary Country field is required.'
        ];
    }
}
