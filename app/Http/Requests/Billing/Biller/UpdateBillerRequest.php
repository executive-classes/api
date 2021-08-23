<?php

namespace App\Http\Requests\Billing\Biller;

use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Billing\BillerStatusEnum;
use App\Http\Requests\Request;
use App\Traits\Requests\EmailRules;
use App\Traits\Requests\PhoneRules;
use App\Traits\Requests\TaxRules;

class UpdateBillerRequest extends Request
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
            'name'                => 'sometimes|string',
            'address_id'          => 'sometimes|numeric|exists:address,id',
            'payment_interval_id' => 'sometimes|numeric|exists:payment_interval,id',
            'payment_method_id'   => 'sometimes|string|exists:payment_method,id',
            'biller_status_id'    => [
                'sometimes',
                'string',
                Rule::in(BillerStatusEnum::getUpdatableValues()),
                new EnumValue(BillerStatusEnum::class)
            ]
        ];
    }
}