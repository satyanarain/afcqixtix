<?php

namespace App\Http\Requests\Shift;

use App\Http\Requests\Request;

class UpdateShiftRequest extends Request
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
                    'shift' => 'required',
                   'abbreviation' => 'required',
                   'start_time' => 'required',
                   'end_time' => 'required',
                   'order_number' => 'required',
                   'system_id' => 'required'
              ];
        
    }

}
