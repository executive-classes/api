<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use App\Traits\Requests\LanguageRules;

class LoginRequest extends Request
{
    use LanguageRules;

    /**
     * Additional rules set of the request.
     *
     * @var array
     */
    protected $additionalRules = [
        'systemLanguage' => 'sometimes'
    ];

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->changeLanguageFromRequest($this->get('language', null));
    }

    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'email'       => 'required|email|exists:user,email',
            'password'    => 'required',
            'remember_me' => 'sometimes|boolean'
        ];
    }

    /**
     * Get the request messages.
     *
     * @return array
     */
    public function getMessages(): array
    {
        return [
            'email.exists' => __('auth.user')
        ];
    }
}
