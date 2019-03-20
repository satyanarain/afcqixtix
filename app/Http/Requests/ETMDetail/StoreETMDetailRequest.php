<?php

namespace App\Http\Requests\ETMDetail;
use App\Http\Requests\Request;
use Validator;
class StoreETMDetailRequest extends Request
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
      
      
      //SELECT `id`, `depot_id`, `etm_no`, `etm_status_master_id`, `sim_no`, `emei_no`, `serial_no`, `"
          //. "make`, `warranty`, `project_period`, `remarks`, `created_at`, `updated_at` FROM `etm_details` WHERE 1
      
        return [
            'depot_id' => 'required',
            'etm_no' => 'required|unique:etm_details,etm_no',
             'etm_status_master_id' => 'required',
             'sim_no' => 'required|unique:etm_details,sim_no',
             'imei_no' => 'required|unique:etm_details,imei_no',
             'serial_no' => 'required|unique:etm_details,serial_no',
             'make' => 'required'           
            ];
        
    }
    public function messages()
    {
        return [
           //  'crew_id.unique' => 'ETM ID already exists',
            'etm_status_master_id.required' => 'Please select status',
            'serial_no.unique' => 'Serial Number already exists.',
            'imei_no.unique' => 'IMEI Number already exists.',
            'sim_no.unique' => 'Sim Number already exists.',
            'etm_no.unique' => 'ETM Number already exists.'
              ];
        
    }
    
    
    
    
}
