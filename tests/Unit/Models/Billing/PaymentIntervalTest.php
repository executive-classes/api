<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\PaymentInterval\PaymentInterval;
use Tests\Unit\Models\ModelTestCase;

class PaymentIntervalTest extends ModelTestCase
{
    /**
     * @var PaymentInterval
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = PaymentInterval::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'payment_interval',
            'timestamps' => false,
            'casts' => [
                'id' => 'int'
            ]
        ]);
    }
}