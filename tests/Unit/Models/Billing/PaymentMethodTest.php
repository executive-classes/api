<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use Tests\Unit\Models\ModelTestCase;

class PaymentMethodTest extends ModelTestCase
{
    /**
     * @var PaymentMethod
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = PaymentMethod::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'payment_method',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}