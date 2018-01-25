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
      $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
           return [
                    'service_id' => 'required|numeric',
                   'stage' => 'required',
                   'adult_ticket_amount' =>  array('required','regex:'.$regex),
                    'child_ticket_amount' =>  array('required','regex:'.$regex),
                   'luggage_ticket_amount' =>  array('required','regex:'.$regex)  
             ];
        
    }

}
