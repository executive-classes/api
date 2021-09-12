<?php

namespace App\Http\Requests\Billing\Address;

use App\Enums\Billing\CountryEnum;
use App\Http\Requests\Request;
use App\Http\Rules\Zip;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;

class AddressRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'zip'        => ['required', new Zip($this->get('country', null))],
            'number'     => 'required|max:10',
            'complement' => 'sometimes|nullable|string|max:255',
            'country'    => ['sometimes', 'string', new EnumValue(CountryEnum::class)],
            'street'     => [
                Rule::requiredIf(function () {
                    return in_array($this->get('country'), [CountryEnum::BR, null]);
                }), 
                'string'
            ],
            'district'   => [
                Rule::requiredIf(function () {
                    return in_array($this->get('country'), [CountryEnum::BR, null]);
                }), 
                'string'
            ],
            'city'       => [
                Rule::requiredIf(function () {
                    return in_array($this->get('country'), [CountryEnum::BR, null]);
                }), 
                'string'
            ],
            'state'      => [
                Rule::requiredIf(function () {
                    return in_array($this->get('country'), [CountryEnum::BR, null]);
                }), 
                'string', 'max:2'
            ],
        ];
    }
}