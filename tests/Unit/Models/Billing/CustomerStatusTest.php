<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\CustomerStatus;
use Tests\Unit\Models\ModelTestCase;

class CustomerStatusTest extends ModelTestCase
{
    /**
     * @var CustomerStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = CustomerStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'customer_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}