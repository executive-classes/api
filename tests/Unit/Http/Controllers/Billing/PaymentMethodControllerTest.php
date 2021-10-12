<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\PaymentMethodController;
use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use App\Http\Resources\Billing\PaymentMethod\PaymentMethodCollection;

class PaymentMethodControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var PaymentMethodController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = PaymentMethodController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(PaymentMethod::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, PaymentMethodCollection::class, 2);
    }
}