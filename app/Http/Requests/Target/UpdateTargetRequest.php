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
                   'duty_number' => 'required',
                   'description' => 'required',
                   'start_time' => 'required',
                   'shift_id' => 'required',
                   'order_number' => 'required'                   
             ];
        
    }

}
