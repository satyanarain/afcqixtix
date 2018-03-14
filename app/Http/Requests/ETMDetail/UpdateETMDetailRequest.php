<?php

namespace App\Http\Requests\ETMDetail;

use App\Http\Requests\Request;

class UpdateETMDetailRequest extends Request
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
   public function rules()
    {
        return [
                  //  'depot_id' => 'required|unique:trip_cancellation_reasons,trip_cancellation_reason_category_master_id'
              //     'depot_id' => 'required|unique:crew_details,depot_id|unique:crew_details,crew_id'
                   
             ];
        
    }
    public function messages()
    {
        return [
            // 'depot_id.unique' => 'The trip cancellation reason has already been taken..',
                  
                  
             ];
        
    }
    
}
