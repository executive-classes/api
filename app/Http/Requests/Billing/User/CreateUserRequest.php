<?php

namespace App\Http\Requests\Billing\User;

use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use App\Enums\System\SystemLanguageEnum;
use App\Rules\BrazillianPhone;
use App\Rules\TaxCode;
use App\Rules\ValidPassword;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
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
            'password' => ['required', new ValidPassword],
            'password_reminder' => 'sometimes|string',
            'tax_type_id' => ['required', 'string', new EnumValue(TaxTypeEnum::class)],
            'tax_code' => ['required', 'string', new TaxCode($this->tax_type_id)],
            'tax_type_alt_id' => ['required_with:tax_code_alt', 'string', new EnumValue(TaxTypeEnum::class)],
            'tax_code_alt' => ['sometimes', 'string', new TaxCode($this->tax_type_alt_id)],
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
            'phone' => ['sometimes', new BrazillianPhone],
            'phone_alt' => 'sometimes',
            'system_language_id' => ['sometimes', 'string', new EnumValue(SystemLanguageEnum::class)]
        ];
    }
}