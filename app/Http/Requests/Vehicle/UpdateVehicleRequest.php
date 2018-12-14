<?php

namespace App\Http\Requests\Vehicle;

use App\Http\Requests\Request;

class UpdateVehicleRequest extends Request
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
                  'depot_id' => 'required',
                   'vehicle_registration_number' => 'required',
                   'bus_type_id' => 'required'
               ];
        
    }
}
