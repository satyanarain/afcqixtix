<?php

namespace App\Http\Requests\ChangePassword;

use App\Http\Requests\Request;

class UpdateChangePasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
            return [
                'currentpassword' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required_with:password|same:password'
               
            ];
     
    }
   public function messages(){
        return [
            'currentpassword.required' => 'The Current password field is required.',
            'password.required' => 'The New password field is required.',
            'password_confirmation.required' => 'The Confirm password field is required.'
            
        ];
    }
}
