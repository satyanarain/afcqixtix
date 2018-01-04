<?php

namespace App\Http\Requests\Target;

use App\Http\Requests\Request;

class StoreTargetRequest extends Request
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
    // `route`, `path`, `direction`, `default_path`, `stop_id`, `stage_number`, `distance`, `hot_key`, `is_this_by`,
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
