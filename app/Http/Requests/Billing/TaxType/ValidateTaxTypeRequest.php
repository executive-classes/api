<?php

namespace App\Http\Requests\Billing\TaxType;

use App\Http\Requests\Request;
use App\Traits\Requests\TaxRules;

class ValidateTaxTypeRequest extends Request
{
    use TaxRules;

    /**
     * Additional rules set of the request.
     *
     * @var array
     */
    protected $additionalRules = [
        'tax' => 'required'
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
}
