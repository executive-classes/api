<?php

namespace App\Http\Requests\Billing\Biller;

use App\Http\Requests\Request;
use App\Traits\Requests\TaxRules;
use App\Traits\Requests\EmailRules;
use App\Traits\Requests\PhoneRules;

class CreateBillerRequest extends Request
{
    use TaxRules;
    use PhoneRules;
    use EmailRules;

    /**
     * Additional rules set of the request.
     *
     * @var array
     */
    protected $additionalRules = [
        'tax' => 'required',
        'phone' => 'sometimes',
        'email' => 'sometimes'
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
            'customer_id'         => 'required|numeric|exists:customer,id',
            'name'                => 'required|string',
            'address_id'          => 'required|numeric|exists:address,id',
            'payment_interval_id' => 'required|numeric|exists:payment_interval,id',
            'payment_method_id'   => 'required|string|exists:payment_method,id',
        ];
    }
}