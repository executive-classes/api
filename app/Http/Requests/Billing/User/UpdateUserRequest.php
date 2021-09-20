<?php

namespace App\Http\Requests\Billing\User;

use App\Traits\Requests\TaxRules;
use App\Traits\Requests\PhoneRules;
use App\Http\Requests\Request;
use App\Traits\Requests\LanguageRules;

class UpdateUserRequest extends Request
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
        'tax' => 'sometimes',
        'phone' => 'sometimes',
        'systemLanguage' => 'sometimes'
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
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:user,email'
        ];
    }
}
