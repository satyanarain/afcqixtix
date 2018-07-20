<?php

namespace App\Http\Requests\Fare;

use App\Http\Requests\Request;

class StoreFareRequest extends Request
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
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
           return [
                   'service_id' => 'required'
              ];
        
    }
  public function messages()
{
    return [
        'service_id.required' => 'Service name required',
        'service_id.unique' => 'The service name has already been taken.',
    ];
}

}
