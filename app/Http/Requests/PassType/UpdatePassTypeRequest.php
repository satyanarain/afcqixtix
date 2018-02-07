<?php

namespace App\Http\Requests\PassType;

use App\Http\Requests\Request;

class UpdatePassTypeRequest extends Request
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
                   'concession_master_id' => 'required',
                   'description' => 'required',
                   'order_number' => 'required',
                   'percentage' => 'required' 
             ];
        
    }

}
