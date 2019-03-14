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
                  'stop' => 'required|unique:stops,stop',
                   'stop_id' => 'required|unique:stops,stop_id',
                   'abbreviation' => 'required|unique:stops,abbreviation',
                   'short_name' => 'required'
             ];
        
    }
}
