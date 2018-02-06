<?php

namespace App\Http\Requests\PayoutReason;

use App\Http\Requests\Request;

class UpdatePayoutReasonRequest extends Request
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
        
// SELECT `id`, `payout_reason`, `short_reason`, `reason_description`, `order_number`, `created_at`, `updated_at` FROM `payout_reasons` WHERE 1
          $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
           return [
                     'payout_reason' => 'required',
                    'short_reason' => 'required',
                    'reason_description' => 'required'
                  
                  
             ];
        
    }

}
