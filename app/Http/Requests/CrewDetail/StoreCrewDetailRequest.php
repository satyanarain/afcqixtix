<?php

namespace App\Http\Requests\CrewDetail;
use App\Http\Requests\Request;
use Validator;
class StoreCrewDetailRequest extends Request
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
            'depot_id' => 'required',
            'crew_name' => 'required',
             'password' => 'required',
             'confirm_password' => 'required_with:password|same:password',
             'crew_id' => 'required|unique:crew_details,crew_id'
           
              ];
        
    }
    public function messages()
    {
        return [
             'crew_id.unique' => 'Crew ID already exists',
            'confirm_password.required' => 'The confirm password field is required.' 
              ];
        
    }
    
    
    
    
}
