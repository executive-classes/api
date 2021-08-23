<?php

namespace App\Http\Requests\Billing\User;

use App\Traits\Requests\TaxRules;
use App\Traits\Requests\PhoneRules;
use App\Http\Requests\Request;
use App\Traits\Requests\LanguageRules;

class CreateUserRequest extends Request
{
    use TaxRules;
    use PhoneRules;
    use LanguageRules;

    /**
     * Additional rules set of the request.
     *
     * @var array
     */
    protected $additionalRules = [
        'tax' => 'required',
        'phone' => 'sometimes',
        'language' => 'sometimes'
    ];

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge($this->formatTaxTypeId());
    }

    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:user,email'
        ];
    }
}
