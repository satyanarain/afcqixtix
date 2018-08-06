<?php

namespace App\Http\Requests\Vehicle;

use App\Http\Requests\Request;

class StoreVehicleRequest extends Request
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
                   'vehicle_registration_number' => 'required|unique:vehicles,vehicle_registration_number',
                   'bus_type_id' => 'required'
             ];
        
    }
}
