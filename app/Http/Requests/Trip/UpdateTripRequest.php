<?php

namespace App\Http\Requests\Trip;

use App\Http\Requests\Request;

class UpdateTripRequest extends Request
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
                //   'route' => 'required',
                   //'route_id' => 'required',
                   'shift_id' => 'required',
                    //'duty_id' => 'required'
                   //'default_path' => 'required',
                   //'default_path' => 'required',
//                   'stop_id' => 'required',
//                   'stage_number' => 'required',
//                   'distance' => 'required',
//                   'hot_key' => 'required',
//                   'is_this_by' => 'required'
             ];
    }

}
