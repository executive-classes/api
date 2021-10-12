<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\PaymentIntervalController;
use App\Models\Eloquent\Billing\PaymentInterval\PaymentInterval;
use App\Http\Resources\Billing\PaymentInterval\PaymentIntervalCollection;

class PaymentIntervalControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var PaymentIntervalController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = PaymentIntervalController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(PaymentInterval::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, PaymentIntervalCollection::class, 2);
    }
}