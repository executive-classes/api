<?php

namespace App\Http\Requests\Mailing\MessageTemplate;

use App\Http\Requests\ApiRequest;
use App\Models\Billing\UserPrivilege;

class MessageTemplateUpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->tokenCan(UserPrivilege::MESSAGE_TEMPLATE_UPDATE) && parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'description'       => 'sometimes|string',
            'subject'           => 'sometimes|string',
            'content'           => 'sometimes|string',
            'message_type_id'   => 'sometimes|alpha_dash',
            'message_header_id' => 'sometimes|alpha_dash',
            'message_footer_id' => 'sometimes|alpha_dash'
        ];

        return array_merge(parent::rules(), $rules);
    }
}
