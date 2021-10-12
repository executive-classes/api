<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\PaymentInterval\PaymentInterval;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class PaymentIntervalTest extends ModelTestCase
{
    use HasFactoryAsserts;

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