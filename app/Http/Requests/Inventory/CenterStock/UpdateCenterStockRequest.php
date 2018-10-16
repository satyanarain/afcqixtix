<?php

namespace App\Http\Requests\Inventory\CenterStock;

use App\Http\Requests\Request;

class UpdateCenterStockRequest extends Request
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
                   'bus_type' => 'required',
                   'abbreviation' => 'required',
                   'order_number' => 'required'
             ];
        
    }

}
