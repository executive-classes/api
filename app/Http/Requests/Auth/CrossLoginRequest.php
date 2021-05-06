<?php

namespace App\Http\Requests\Auth;

use App\Enums\Billing\UserPrivilegeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CrossLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'  => 'required|numeric|exists:user,id',
            'language' => 'sometimes|in:en,pt_BR',
        ];
    }
}
