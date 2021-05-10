<?php

namespace App\Http\Requests\Billing\Address;

use App\Enums\Billing\CountryEnum;
use App\Rules\Zip;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
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
            'zip' => ['required', new Zip($this->get('country', null))],
            'number' => 'required|max:10',
            'complement' => 'sometimes|nullable|string|max:255',
            'country' => ['sometimes', 'string', new EnumValue(CountryEnum::class)],
            'street' => [
                Rule::requiredIf(function () {
                    return !in_array($this->get('country'), [CountryEnum::BR, null]);
                }), 
                'string'
            ],
            'district' => [
                Rule::requiredIf(function () {
                    return !in_array($this->get('country'), [CountryEnum::BR, null]);
                }), 
                'string'
            ],
            'city' => [
                Rule::requiredIf(function () {
                    return !in_array($this->get('country'), [CountryEnum::BR, null]);
                }), 
                'string'
            ],
            'state' => [
                Rule::requiredIf(function () {
                    return !in_array($this->get('country'), [CountryEnum::BR, null]);
                }), 
                'string', 'max:2'
            ],
        ];
    }
}