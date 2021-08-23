<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\InvoiceStatus\InvoiceStatus;
use Tests\Unit\Models\ModelTestCase;

class InvoiceStatusTest extends ModelTestCase
{
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