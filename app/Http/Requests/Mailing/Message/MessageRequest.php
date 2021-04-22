<?php

namespace App\Http\Requests\Mailing\Message;

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Requests\ApiRequest;

class MessageRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->tokenCan(UserPrivilegeEnum::MESSAGE_GET) && parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        return array_merge(parent::rules(), $rules);
    }
}
