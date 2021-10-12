<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\TaxType\TaxType;
use App\Enums\Billing\TaxTypeEnum;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use App\Services\Billing\Tax\Contract\Tax;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class TaxTypeTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var TaxType
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = TaxType::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'tax_type',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }

    public function test_tax_function()
    {
        $this->assertHasMethod(TaxType::class, 'tax');

        foreach (TaxTypeEnum::getValues() as $tax) {
            $this->model->id = $tax;
            $taxClass = $this->model->tax();
            $this->assertInstanceOf(Tax::class, $taxClass);
        }
    }

    public function test_validate_function()
    {
        $this->assertHasMethod(TaxType::class, 'validate');
    }

    public function test_mask_function()
    {
        $this->assertHasMethod(TaxType::class, 'mask');
    }
}