<?php

namespace App\Http\Requests\Target;

use App\Http\Requests\Request;

class UpdateTargetRequest extends Request
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
                   'route_id' => 'required',
                   'duty_id' => 'required',
                   'shift_id' => 'required',
                   'epkm' => 'required',
                    'trip' => 'required'                   
             ];
        
    }

}
