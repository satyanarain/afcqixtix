<?php

namespace App\Http\Requests\PassType;

use App\Http\Requests\Request;

class StorePassTypeRequest extends Request
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
     //   SELECT `id`, `user_id`, `service_id`, `concession_provider_master_id`, `pass_type_master_id`, `description`, `short_description`, `amount`, `info_message`, `validity_message`, `accept_gender`, `accept_age`, `accept_age_from`, `accept_age_to`, `accept_spouse_age`, `accept_spouse_age_from`, `accept_spouse_age_to`, `accept_id_number`, `order_number`, `created_at`, `updated_at` FROM `pass_types` WHERE 1
           return [
                   //'service_id' => 'required|unique:depots,service_id,concession_provider_master_id,pass_type_master_id',
                   //'service_id' => 'required',
                   'concession_provider_master_id' => 'required',
                   'short_description' => 'required',
                   'info_message' => 'required',
                   'validity_message' => 'required',
                   'pass_type_master_id' => 'required|unique:pass_types,pass_type_master_id'
  
             ];
        
    }
}
