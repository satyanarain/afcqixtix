<?php

namespace App\Http\Requests\Crew;
use App\Http\Requests\Request;
use Validator;
class StoreCrewRequest extends Request
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
        return [
            //'depot_id' => 'required',
            'crew_name' => 'required',
             //'password' => 'required',
             //'confirm_password' => 'required_with:password|same:password',
             'crew_id' => 'required|unique:crew,crew_id',
             'licence_no' => 'required|unique:crew,licence_no'
           
              ];
        
    }
    public function messages()
    {
        return [
            'crew_id.unique' => 'Crew ID already exists',
            'confirm_password.required' => 'The confirm password field is required.',
            'licence_no.unique' => 'Licence Number already exists.'
              ];
        
    }
    
    
    
    
}
