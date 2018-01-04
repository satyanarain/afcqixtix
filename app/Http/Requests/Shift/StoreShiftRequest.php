<?php

namespace App\Http\Requests\Shift;

use App\Http\Requests\Request;

class StoreShiftRequest extends Request
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
//SELECT `id`, `shift`, `abbreviation`, `start_date`, `end_date`, `order_number`, `system_id`, `created_at`, `updated_at` FROM `shifts` WHERE 1
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
                   'start_date' => 'required',
                   'start_date' => 'required',
                   'end_date' => 'required',
                   'order_number' => 'required',
                   'system_id' => 'required'
              ];
        
    }
}
