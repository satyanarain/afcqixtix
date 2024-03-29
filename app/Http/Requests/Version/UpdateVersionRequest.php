<?php

namespace App\Http\Requests\Version;

use App\Http\Requests\Request;

class UpdateVersionRequest extends Request
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
                  'downloading_wef' => 'required',
                  'reason' => 'required',
             ];
        
    }

}
