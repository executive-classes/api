<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'       => 'required|email|exists:user,email',
            'password'    => 'required',
            'language'    => 'sometimes|in:en,pt_BR',
            'remember_me' => 'sometimes|boolean'
        ];
    }
}
