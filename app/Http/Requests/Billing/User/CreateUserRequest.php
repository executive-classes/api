<?php

namespace App\Http\Requests\Billing\User;

use App\Rules\TaxCode;
use Illuminate\Support\Str;
use App\Rules\ValidPassword;
use App\Rules\BrazillianPhone;
use Illuminate\Validation\Rule;
use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\System\SystemLanguageEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:user,email',
            'tax_type_id' => [
                'required',
                'string',
                'different:tax_type_alt_id',
                new EnumValue(TaxTypeEnum::class)
            ],
            'tax_code' => ['required', 'string', new TaxCode($this->tax_type_id, $this->uf ?? null)],
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
                        $this->only(['tax_type_id', 'tax_type_alt_id'])
                    )
                ),
                'string',
                'max:2',
                new EnumValue(StateEnum::class)
            ],
            'phone' => ['sometimes', new BrazillianPhone],
            'phone_alt' => 'sometimes',
            'system_language_id' => ['sometimes', 'string', new EnumValue(SystemLanguageEnum::class)]
        ];
    }
}
