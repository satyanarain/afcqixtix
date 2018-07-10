<?php

namespace App\Http\Requests\PayoutReason;

use App\Http\Requests\Request;

class StorePayoutReasonRequest extends Request
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
                   'payout_reason' => 'required|unique:payout_reasons',
                    'short_reason' => 'required',
                    'reason_description' => 'required'
                  
            
                  
             ];
        
    }
    public function messages()
    {
        return [
           //  'trip_cancellation_reason_category_master_id.unique' => 'The trip cancellation reason has already been taken..',
                  
                  
             ];
        
    }
    
    
    
    
    
}
