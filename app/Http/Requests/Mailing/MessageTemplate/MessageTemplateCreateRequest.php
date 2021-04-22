<?php

namespace App\Http\Requests\Mailing\MessageTemplate;

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Requests\ApiRequest;

class MessageTemplateCreateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->tokenCan(UserPrivilegeEnum::MESSAGE_TEMPLATE_CREATE) && parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'id'                => 'required|alpha_dash',
            'description'       => 'required|string',
            'subject'           => 'required|string',
            'content'           => 'required|string',
            'message_type_id'   => 'required|alpha_dash',
            'message_header_id' => 'required|alpha_dash',
            'message_footer_id' => 'required|alpha_dash'
        ];

        return array_merge(parent::rules(), $rules);
    }
}
