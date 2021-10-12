<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class PaymentMethodTest extends ModelTestCase
{
    use HasFactoryAsserts;

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