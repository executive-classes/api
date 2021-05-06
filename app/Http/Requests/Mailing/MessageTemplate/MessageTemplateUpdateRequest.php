<?php

namespace App\Http\Requests\Mailing\MessageTemplate;

use App\Enums\Billing\UserPrivilegeEnum;
use Illuminate\Foundation\Http\FormRequest;

class MessageTemplateUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
