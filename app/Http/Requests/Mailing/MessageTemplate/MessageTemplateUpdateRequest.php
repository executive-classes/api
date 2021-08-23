<?php

namespace App\Http\Requests\Mailing\MessageTemplate;

use App\Http\Requests\Request;

class MessageTemplateUpdateRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'description'       => 'sometimes|string',
            'subject'           => 'sometimes|string',
            'content'           => 'sometimes|string',
            'message_type_id'   => 'sometimes|alpha_dash',
            'message_header_id' => 'sometimes|alpha_dash',
            'message_footer_id' => 'sometimes|alpha_dash'
        ];
    }
}
