<?php

namespace App\Http\Requests\TripCancellationReason;

use App\Http\Requests\Request;

class StoreTripCancellationReasonRequest extends Request
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
                    'short_reason' => 'required|unique:trip_cancellation_reasons',
                    'trip_cancellation_reason_category_master_id' => 'required',
                    
                  
             ];
        
    }
    public function messages()
    {
        return [
             'short_reason.required' => 'The trip cancellation reason is required.',
            'trip_cancellation_reason_category_master_id.required' => 'The trip cancellation reason category is required.',
                  
                  
             ];
        
    }
    
    
    
    
    
}
