<?php

namespace App\Http\Requests\Mailing\Message;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

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
            'should_process_at'   => 'sometimes|date',
            'reply_to'            => 'required|string|email',
            'to'                  => 'required|string',
            'cc'                  => 'sometimes|string',
            'bcc'                 => 'sometimes|string',
            'subject'             => [
                Rule::requiredIf(empty($this->get('message_template_id'))),
            ],
            'content'             => [
                Rule::requiredIf(empty($this->get('message_template_id'))),
            ],
            'message_template_id' => [
                Rule::requiredIf(empty($this->get('content'))),
                'string',
                'exists:message_template,id'
            ],
            'params'              => [
                Rule::requiredIf(empty($this->get('content'))),
            ],
        ];
    }
}
