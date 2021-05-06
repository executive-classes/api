<?php

namespace App\Http\Requests\Mailing\Message;

use App\Enums\Billing\UserPrivilegeEnum;
use Illuminate\Foundation\Http\FormRequest;

class MessageCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'should_proccess_at'  => 'sometimes|date',
            'reply_to'            => 'required|string|email',
            'to'                  => 'required|string',
            'cc'                  => 'sometimes|string',
            'bcc'                 => 'sometimes|string',
            'subject'             => 'required_if:message_template_id,null',
            'content'             => 'required_if:message_template_id,null',
            'message_template_id' => 'required_if:content,null|string|exists:message_template,id',
            'params'              => 'required_if:content,null',
        ];
    }
}
