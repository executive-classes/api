<?php

namespace App\Http\Requests\Billing\Customer;

use App\Rules\TaxCode;
use Illuminate\Support\Str;
use App\Rules\BrazillianPhone;
use Illuminate\Validation\Rule;
use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Billing\CustomerStatusEnum;
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $data = [];

        if ($this->get('tax_type_id', false)) {
            $data['tax_type_id'] = Str::lower($this->input('tax_type_id'));
        }

        if ($this->get('tax_type_alt_id', false)) {
            $data['tax_type_alt_id'] = Str::lower($this->input('tax_type_alt_id'));
        }

        $this->merge($data);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|string',
            'tax_type_id' => [
                'required_with:tax_code',
                'string',
                'different:tax_type_alt_id',
                new EnumValue(TaxTypeEnum::class)
            ],
            'tax_code' => ['sometimes', 'string', new TaxCode($this->tax_type_id, $this->uf ?? null)],
            'tax_type_alt_id' => [
                'required_with:tax_code_alt',
                'nullable',
                'string',
                'different:tax_type_id',
                new EnumValue(TaxTypeEnum::class)
            ],
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
            'phone' => ['sometimes', 'nullable', new BrazillianPhone],
            'phone_alt' => 'sometimes|nullable',
        ];
    }
}