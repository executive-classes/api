<?php

namespace App\Traits\Requests;

use App\Http\Rules\TaxCode;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Enums\Billing\TaxTypeEnum;
use BenSampo\Enum\Rules\EnumValue;

trait TaxRules
{
    public function getTaxRules(string $required = 'sometimes')
    {
        return [
            'tax_type_id' => [
                $required === 'required' ? $required : 'required_with:tax_code',
                'string',
                'different:tax_type_alt_id',
                new EnumValue(TaxTypeEnum::class)
            ],
            'tax_code' => [
                $required === 'required' ? $required : 'required_with:tax_type_id',
                'string', 
                new TaxCode($this->tax_type_id, $this->uf ?? null)
            ],
            'tax_type_alt_id' => [
                'required_with:tax_code_alt',
                'nullable',
                'string',
                'different:tax_type_id',
                new EnumValue(TaxTypeEnum::class)
            ],
            'tax_code_alt' => [
                'required_with:tax_type_alt_id',
                'nullable', 
                'string', 
                new TaxCode($this->tax_type_alt_id, $this->uf ?? null)
            ],
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
        ];
    }

    protected function formatTaxTypeId()
    {
        $data = [];

        if ($this->get('tax_type_id', false)) {
            $data['tax_type_id'] = Str::lower($this->input('tax_type_id'));
        }

        if ($this->get('tax_type_alt_id', false)) {
            $data['tax_type_alt_id'] = Str::lower($this->input('tax_type_alt_id'));
        }

        return $data;
    }
}