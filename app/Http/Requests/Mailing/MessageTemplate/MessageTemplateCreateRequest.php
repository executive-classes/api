<?php

namespace App\Http\Requests\Mailing\MessageTemplate;

use App\Http\Requests\Request;

class MessageTemplateCreateRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'id'                => 'required|alpha_dash',
            'description'       => 'required|string',
            'subject'           => 'required|string',
            'content'           => 'required|string',
            'message_type_id'   => 'required|alpha_dash',
            'message_header_id' => 'required|alpha_dash',
            'message_footer_id' => 'required|alpha_dash'
        ];
    }
}
