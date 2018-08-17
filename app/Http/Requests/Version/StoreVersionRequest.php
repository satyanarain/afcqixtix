<?php

namespace App\Http\Requests\Version;

use App\Http\Requests\Request;

class StoreVersionRequest extends Request
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
                  'downloading_wef' => 'required',
                  'reason' => 'required',
             ];
        
    }
}
