<?php

namespace App\Http\Requests\CreatePassword;

use App\Http\Requests\Request;

class UpdateCreatePasswordRequest extends Request
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
                
                'password' => 'required',
                'password_confirmation' => 'required_with:password|same:password'
               
            ];
     
    }
   public function messages(){
        return [
             'password_confirmation.required' => 'The Confirm password field is required.'
            
        ];
    }
}
