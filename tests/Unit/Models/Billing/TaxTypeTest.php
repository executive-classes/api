<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\TaxType;
use App\Enums\Billing\TaxTypeEnum;
use Tests\Unit\Models\ModelTestCase;
use App\Services\Billing\Tax\Contract\Tax;

class TaxTypeTest extends ModelTestCase
{
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