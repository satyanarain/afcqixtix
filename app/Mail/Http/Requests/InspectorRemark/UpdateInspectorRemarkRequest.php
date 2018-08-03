<?php

namespace App\Http\Requests\InspectorRemark;

use App\Http\Requests\Request;

class UpdateInspectorRemarkRequest extends Request
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
        
 //SELECT `id`, `user_id`, `trip_cancellation_reason_category_master_id`, `short_reason`, `reason_description`, `order_number`, `created_at`, `updated_at` FROM `inspector_remarks` WHERE 1   
   
          $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
           return [
                     'short_remark' => 'required',
                    'remark_description' => 'required'
                  
             ];
        
    }

}
