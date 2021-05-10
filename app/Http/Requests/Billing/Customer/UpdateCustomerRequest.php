<?php

namespace App\Http\Requests\Billing\Customer;

use App\Enums\Billing\CustomerStatusEnum;
use App\Rules\TaxCode;
use App\Rules\BrazillianPhone;
use Illuminate\Validation\Rule;
use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|string',
            'tax_type_id' => ['required_with:tax_code', 'string', new EnumValue(TaxTypeEnum::class)],
            'tax_code' => ['sometimes', 'string', new TaxCode($this->tax_type_id, $this->uf ?? null)],
            'tax_type_alt_id' => ['required_with:tax_code_alt', 'nullable', 'string', new EnumValue(TaxTypeEnum::class)],
            'tax_code_alt' => ['sometimes', 'nullable', 'string', new TaxCode($this->tax_type_alt_id, $this->uf ?? null)],
            'uf' => [
                Rule::requiredIf(
                    in_array(
                        TaxTypeEnum::IE, 
                        $this->only(['tax_type_id','tax_type_alt_id'])
                    )
                ), 
                'string', 
                'max:2', 
                new EnumValue(StateEnum::class)
            ],
            'address_id' => 'sometimes|numeric|exists:address,id',
            'customer_status_id' => [
                'sometimes', 
                'string',
                Rule::in(CustomerStatusEnum::getUpdatableValues()), 
                new EnumValue(CustomerStatusEnum::class)
            ],
            'email' => 'sometimes|nullable|email',
            'phone' => ['sometimes', new BrazillianPhone],
            'phone_alt' => 'sometimes',
        ];
    }
}