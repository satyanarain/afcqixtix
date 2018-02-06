<?php

namespace App\Http\Requests\Denomination;

use App\Http\Requests\Request;

class StoreDenominationRequest extends Request
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
    // `route`, `path`, `direction`, `default_path`, `stop_id`, `stage_number`, `distance`, `hot_key`, `is_this_by`,
    public function rules()
    {
        return [
                    'denomination_master_id' => 'required|unique:denominations,denomination_master_id',
                    'denomination' => 'required',
                    'description' => 'required',
                    'price' => 'required'
                  
             ];
        
    }
    public function messages()
    {
        return [
             'denomination_master_id.unique' => 'Denomination Type has already been taken..',
               ];
        
    }
    
    
    
    
    
}
