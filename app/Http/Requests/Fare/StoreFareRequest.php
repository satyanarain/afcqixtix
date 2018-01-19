<?php

namespace App\Http\Requests\Fare;

use App\Http\Requests\Request;

class StoreFareRequest extends Request
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
                    'service_id' => 'required',
                   'stage' => 'required',
                   'adult_ticket_amount' => 'required',
                   'child_ticket_amount' => 'required',
                   'luggage_ticket_amount' => 'required'   
             ];
        
    }
}
