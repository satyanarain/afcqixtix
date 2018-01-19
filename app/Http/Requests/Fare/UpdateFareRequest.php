<?php

namespace App\Http\Requests\Fare;

use App\Http\Requests\Request;

class UpdateFareRequest extends Request
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
                   'service_id' => 'required',
                   'stage' => 'required',
                   'adult_ticket_amount' => 'required',
                   'child_ticket_amount' => 'required',
                   'luggage_ticket_amount' => 'required'                                    
             ];
        
    }

}
