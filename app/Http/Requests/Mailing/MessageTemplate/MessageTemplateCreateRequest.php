<?php

namespace App\Http\Requests\Mailing\MessageTemplate;

use App\Enums\Billing\UserPrivilegeEnum;
use Illuminate\Foundation\Http\FormRequest;

class MessageTemplateCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
