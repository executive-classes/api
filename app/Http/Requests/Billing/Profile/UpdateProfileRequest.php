<?php

namespace App\Http\Requests\Billing\Profile;

use App\Rules\TaxCode;
use App\Rules\ValidPassword;
use App\Rules\BrazillianPhone;
use Illuminate\Validation\Rule;
use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\System\SystemLanguageEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'email' => 'sometimes|email|unique:user,email',
            'password' => ['sometimes', new ValidPassword],
            'password_reminder' => 'sometimes|nullable|string',
            'tax_type_id' => [
                'required_with:tax_code',
                'string',
                'different:tax_type_alt_id',
                new EnumValue(TaxTypeEnum::class)
            ],
            'tax_code' => ['required_with:tax_type_id', 'string', new TaxCode($this->tax_type_id)],
            'tax_type_alt_id' => [
                'required_with:tax_code_alt',
                'nullable',
                'string',
                'different:tax_type_id',
                new EnumValue(TaxTypeEnum::class)
            ],
            'tax_code_alt' => ['required_with:tax_type_alt_id', 'nullable', 'string', new TaxCode($this->tax_type_alt_id)],
            'uf' => [
                Rule::requiredIf(
                    in_array(
                        TaxTypeEnum::IE,
                        $this->only(['tax_type_id', 'tax_type_alt_id'])
                    )
                ),
                'string',
                'max:2',
                new EnumValue(StateEnum::class)
            ],
            'phone' => ['sometimes', 'nullable', new BrazillianPhone],
            'phone_alt' => 'sometimes|nullable',
            'system_language_id' => ['sometimes', 'string', new EnumValue(SystemLanguageEnum::class)]
        ];
    }
}
