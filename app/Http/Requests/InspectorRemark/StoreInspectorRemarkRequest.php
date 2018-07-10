<?php

namespace App\Http\Requests\InspectorRemark;

use App\Http\Requests\Request;

class StoreInspectorRemarkRequest extends Request
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
                    'inspector_remark' => 'required|unique:inspector_remarks,inspector_remark',
                    'short_remark' => 'required',
                    'remark_description' => 'required'
            
                  
             ];
        
    }
    public function messages()
    {
        return [
           //  'trip_cancellation_reason_category_master_id.unique' => 'The trip cancellation reason has already been taken..',
                  
                  
             ];
        
    }
    
    
    
    
    
}
