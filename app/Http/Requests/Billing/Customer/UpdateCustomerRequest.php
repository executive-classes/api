<?php

namespace App\Http\Requests\Billing\Customer;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use App\Traits\Requests\TaxRules;
use BenSampo\Enum\Rules\EnumValue;
use App\Traits\Requests\EmailRules;
use App\Traits\Requests\PhoneRules;
use App\Enums\Billing\CustomerStatusEnum;

class UpdateCustomerRequest extends Request
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
        'tax' => 'sometimes',
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
            'name'               => 'sometimes|string',
            'address_id'         => 'sometimes|numeric|exists:address,id',
            'customer_status_id' => [
                'sometimes', 
                'string',
                Rule::in(CustomerStatusEnum::getUpdatableValues()), 
                new EnumValue(CustomerStatusEnum::class)
            ]
        ];
    }
}