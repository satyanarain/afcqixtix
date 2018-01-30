<?php

namespace App\Http\Requests\Concession;

use App\Http\Requests\Request;

class StoreConcessionRequest extends Request
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
                // 'name' => 'required|unique:depots,name',
                   'service_id' => 'required|unique:concessions,service_id',
                   'concession_master_id' => 'required',
                   'description' => 'required',
                   'order_number' => 'required',
                   'percentage' => 'required'
  
             ];
        
    }
}
