<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\Billing\UserPrivilege;

class CrossLoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->tokenCan(UserPrivilege::CROSS_AUTH) && parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'user_id'  => 'required|numeric|exists:user,id',
            'language' => 'sometimes|in:en,pt_BR',
        ];

        return array_merge(parent::rules(), $rules);
    }
}