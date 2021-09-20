<?php

namespace Tests\Unit\Traits\Requests;

use App\Enums\Billing\StateEnum;
use Illuminate\Support\Str;
use App\Enums\Billing\TaxTypeEnum;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use NunoMaduro\Collision\Adapters\Phpunit\State;

trait TaxRulesAsserts
{
    public function test_tax_type_id_field()
    {
        $this->tax_type_asserts('tax_type_id', 'tax_code');
    }
    
    public function test_tax_code_field()
    {
        $this->tax_code_asserts('tax_type_id', 'tax_code');
    }

    public function test_tax_type_alt_id_field()
    {
        $this->tax_type_asserts('tax_type_alt_id', 'tax_code_alt', true);
    }

    public function test_tax_code_alt_field()
    {
        $this->tax_code_asserts('tax_type_alt_id', 'tax_code_alt', true);
    }

    public function test_uf_field()
    {
        $field = 'uf';
        $taxFields = [
            'tax_type_id' => 'tax_code',
            'tax_type_alt_id' => 'tax_code_alt'
        ];
        
        foreach ($taxFields as $taxTypeField => $codeField) {
            $this->assertRequiredWithRule($field, [$taxTypeField => TaxTypeEnum::IE, $codeField => 'some tax']);
            $this->assertEnumRule($field, StateEnum::getValues());
            $this->assertNotNullableRule($field);
        }
    }

    public function test_type_can_be_lowed()
    {
        foreach (TaxTypeEnum::getValues() as $tax) {
            $request = $this->executePrepareForValidation(['tax_type_id' => Str::upper($tax), 'tax_type_alt_id' => Str::upper($tax)]);

            $this->assertEquals($request->tax_type_id, $tax);
            $this->assertEquals($request->tax_type_alt_id, $tax);
        }
    }

    private function tax_type_asserts(
        string $taxTypeField,
        string $codeField,
        bool $alt = false
    ) {
        if ($alt || !$this->checkRequiredAdditionalRule('tax')) {
            $this->assertRequiredWithRule($taxTypeField, [$codeField => 'some tax']);
        } else {
            $this->assertRequiredRule($taxTypeField);
        }

        if ($alt) {
            $this->assertNullableRule($taxTypeField);
        } else {
            $this->assertNotNullableRule($taxTypeField);
        }

        $this->assertEnumRule($taxTypeField, TaxTypeEnum::getValues());
        $this->assertDifferentRule('tax_type_id','tax_type_alt_id', TaxTypeEnum::getRandomValue());
    }

    private function tax_code_asserts(
        string $taxTypeField, 
        string $codeField, 
        bool $alt = false
    ) {
        foreach (TaxTypeEnum::getValues() as $taxType) {
            $this->db
                ->byDefault()
                ->shouldReceive('select')
                ->andReturn([TaxType::factory(['id' => $taxType])->make()->toArray()]);


            // Required test
            if ($alt || !$this->checkRequiredAdditionalRule('tax')) {
                $this->assertRequiredWithRule($codeField, [$taxTypeField => $taxType]);
            } else {
                $this->assertRequiredRule($codeField);
            }

            // Value testes
            $taxes = config('test.tax.' . $taxType);
            if ($taxType != TaxTypeEnum::IE) {
                foreach ($taxes['valid'] as $tax) {
                    $this->assertPasses($codeField, [$taxTypeField => $taxType, $codeField => $tax]);
                }
                foreach ($taxes['invalid'] as $tax) {
                    $this->assertNotPasses($codeField, [$taxTypeField => $taxType, $codeField => $tax]);
                }
            } else {
                $state = StateEnum::getRandomValue();
                foreach ($taxes['valid'][$state] as $tax) {
                    $this->assertPasses($codeField, [$taxTypeField => $taxType, $codeField => $tax, 'uf' => $state]);
                }
                foreach ($taxes['invalid'][$state] as $tax) {
                    $this->assertNotPasses($codeField, [$taxTypeField => $taxType, $codeField => $tax, 'uf' => $state]);
                }
            }

            if ($alt) {
                $this->assertNullableRule($taxTypeField);
            } else {
                $this->assertNotNullableRule($taxTypeField);
            }
        }
    }
}