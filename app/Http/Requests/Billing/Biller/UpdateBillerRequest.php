<?php

namespace App\Http\Requests\Billing\Biller;

use App\Enums\Billing\BillerStatusEnum;
use App\Rules\TaxCode;
use App\Rules\BrazillianPhone;
use Illuminate\Validation\Rule;
use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBillerRequest extends FormRequest
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
            'biller_status_id' => [
                'sometimes', 
                'string',
                Rule::in(BillerStatusEnum::getUpdatableValues()), 
                new EnumValue(BillerStatusEnum::class)
            ],
            'email' => 'sometimes|nullable|email',
            'phone' => ['sometimes', new BrazillianPhone],
            'phone_alt' => 'sometimes',
            'payment_interval_id' => 'sometimes|numeric|exists:payment_interval,id',
            'payment_method_id' => 'sometimes|string|exists:payment_method,id',
        ];
    }
}