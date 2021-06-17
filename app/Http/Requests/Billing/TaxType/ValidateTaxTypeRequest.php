<?php

namespace App\Http\Requests\Billing\TaxType;

use App\Enums\Billing\StateEnum;
use Illuminate\Support\Str;
use App\Enums\Billing\TaxTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class ValidateTaxTypeRequest extends FormRequest
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
        $this->merge([
            'tax_type_id' => Str::lower($this->input('tax_type_id'))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tax_type_id' => ['required', 'string', new EnumValue(TaxTypeEnum::class)],
            'tax_code' => 'required|string',
            'uf' => [
                'required_if:tax_type_id,' . TaxTypeEnum::IE,
                'string',
                'max:2',
                new EnumValue(StateEnum::class)
            ],
        ];
    }
}
