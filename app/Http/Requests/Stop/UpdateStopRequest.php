<?php

namespace App\Http\Requests\Stop;

use App\Http\Requests\Request;

class UpdateStopRequest extends Request
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
                  'stop' => 'required',
                   'stop_id' => 'required',
                   'abbreviation' => 'required',
                   'short_name' => 'required'
             ];
        
    }

}
