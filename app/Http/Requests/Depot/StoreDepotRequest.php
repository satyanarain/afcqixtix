<?php

namespace App\Http\Requests\Depot;

use App\Http\Requests\Request;

class StoreDepotRequest extends Request
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
                 //'name'=>'required',
                   'name' => 'required|unique:depots,name',
                    'depot_id' => 'required|unique:depots,depot_id|integer',
                   'short_name' => 'required',
                   'depot_location' => 'required',
                   'default_service' => 'required'
             ];
        
    }
}
