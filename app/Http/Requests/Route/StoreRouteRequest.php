<?php

namespace App\Http\Requests\Route;

use App\Http\Requests\Request;
use Illuminate\Validation\Validation;
class StoreRouteRequest extends Request
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
                //   'route' => 'required',
                   'source' => 'required',
                   'direction' => 'required',
                    //'route' => 'unique_with:routes,direction',
                   //'default_path' => 'required',
                   //'default_path' => 'required',
//                   'stop_id' => 'required',
//                   'stage_number' => 'required',
//                   'distance' => 'required',
//                   'hot_key' => 'required',
//                   'is_this_by' => 'required'
             ];
        
    }
}
