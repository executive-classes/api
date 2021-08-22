<?php

namespace App\Http\Requests\Auth;

use App\Enums\System\SystemLanguageEnum;
use App\Models\System\SystemLanguage\SystemLanguage;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('language') && SystemLanguageEnum::hasValue($this->language)) {
            SystemLanguage::findOrFail($this->language)->updateSystemLocale();
        }
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
            'language'    => ['sometimes', new EnumValue(SystemLanguageEnum::class)],
            'remember_me' => 'sometimes|boolean'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.exists' => __('auth.user')
        ];
    }
}
