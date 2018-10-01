<?php

namespace App\Http\Requests\RouteMaster;

use App\Http\Requests\Request;

class UpdateRouteMasterRequest extends Request
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
        
            return [
                   'route_name' => 'required',
//                   'source' => 'required',
//                   'direction' => 'required'
             ];
        
    }

}
