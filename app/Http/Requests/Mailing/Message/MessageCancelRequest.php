<?php

namespace App\Http\Requests\Mailing\Message;

use App\Models\Billing\UserPrivilege;
use Illuminate\Foundation\Http\FormRequest;

class MessageCancelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->tokenCan(UserPrivilege::MESSAGE_CANCEL) && parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            
        ];

        return array_merge(parent::rules(), $rules);
    }
}
