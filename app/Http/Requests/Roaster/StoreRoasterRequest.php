<?php

namespace App\Http\Requests\Roaster;
use App\Http\Requests\Request;
use Validator;
class StoreRoasterRequest extends Request
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
            ];
        
    }
    public function messages()
    {
        return [
           //  'crew_id.unique' => 'ETM ID already exists',
            'depot_id.required' => 'Please select depot id' 
              ];
        
    }
    
    
    
    
}
