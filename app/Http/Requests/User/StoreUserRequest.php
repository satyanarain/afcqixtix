<?php

namespace App\Http\Requests\User;
use App\Http\Requests\Request;
use Validator;
class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return auth()->user()->can('user-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    
    public function rules()
    {
      Validator::extend('without_spaces', function($attr, $value){
    return preg_match('/^\S*$/u', $value);
});

return [
                 'name' => 'required',
                 'user_name' => 'required|without_spaces|unique:users,user_name',
                 'email' => 'required',
                 'country' => 'required',
                 'mobile' => 'required'
             ];
        
    }
    
  
    public function messages(){
        return [
            'user_name.without_spaces' => 'Space Is Not Allowed In User Name.',
        ];
    }  
    
    
    
    
    
}
