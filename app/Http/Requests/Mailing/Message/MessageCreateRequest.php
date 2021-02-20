<?php

namespace App\Http\Requests\Mailing\Message;

use App\Http\Requests\ApiRequest;
use App\Models\Billing\UserPrivilege;

class MessageCreateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->tokenCan(UserPrivilege::MESSAGE_CREATE) && parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'should_proccess_at'  => 'sometimes|date',
            'from'                => 'required|string|email',
            'to'                  => 'required|string',
            'cc'                  => 'sometimes|string',
            'bcc'                 => 'sometimes|string',
            'subject'             => 'required|string',
            'content'             => 'required_if:message_template_id,null',
            'message_template_id' => 'required_if:content,null|string|exists:message_template,id',
            'params'              => 'required_if:content,null',
        ];

        return array_merge(parent::rules(), $rules);
    }
}
