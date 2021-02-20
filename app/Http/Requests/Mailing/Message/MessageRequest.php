<?php

namespace App\Http\Requests\Mailing\Message;

use App\Http\Requests\ApiRequest;
use App\Models\Billing\UserPrivilege;

class MessageRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->tokenCan(UserPrivilege::MESSAGE_GET) && parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            
        ];

        return array_merge(parent::rules(), $rules);
    }
}
