<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\InvoiceStatus\InvoiceStatus;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class InvoiceStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var InvoiceStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = InvoiceStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'invoice_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}