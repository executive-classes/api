<?php

namespace App\Http\Requests\Billing\Customer;

use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use App\Rules\BrazillianPhone;
use App\Rules\TaxCode;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCustomerRequest extends FormRequest
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
            'name' => 'required|string',
            'tax_type_id' => ['required', 'string', new EnumValue(TaxTypeEnum::class)],
            'tax_code' => ['required', 'string', new TaxCode($this->tax_type_id, $this->uf ?? null)],
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
            'address_id' => 'required|numeric|exists:address,id',
            'email' => 'sometimes|nullable|email',
            'phone' => ['sometimes', new BrazillianPhone],
            'phone_alt' => 'sometimes',
        ];
    }
}