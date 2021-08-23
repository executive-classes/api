<?php

namespace App\Http\Requests\Mailing\Message;

use App\Http\Requests\Request;

class MessageCreateRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
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
