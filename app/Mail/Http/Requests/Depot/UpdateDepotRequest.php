<?php

namespace App\Http\Requests\Depot;

use App\Http\Requests\Request;

class UpdateDepotRequest extends Request
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
                 'name' => 'required',
                 // 'depot_id' => 'required',
                 //  'short_name' => 'required',
                 //  'depot_location' => 'required',
                  // 'default_service' => 'required'
             ];
        
    }

}
