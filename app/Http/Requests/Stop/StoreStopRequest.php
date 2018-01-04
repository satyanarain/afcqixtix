<?php

namespace App\Http\Requests\Stop;

use App\Http\Requests\Request;

class StoreStopRequest extends Request
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
                  'stop' => 'required',
                   'stop_id' => 'required',
                   'abbreviation' => 'required',
                   'short_name' => 'required'
             ];
        
    }
}
