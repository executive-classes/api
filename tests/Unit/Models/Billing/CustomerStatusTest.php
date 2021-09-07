<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\CustomerStatus\CustomerStatus;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class CustomerStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

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