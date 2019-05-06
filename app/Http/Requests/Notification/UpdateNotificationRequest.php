<?php

namespace App\Http\Requests\Notification;

use App\Http\Requests\Request;

class UpdateNotificationRequest extends Request
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
                'notification_type' => 'required',
                'email' => 'required',
                'name' => 'required'
            ];
        
    }

}
