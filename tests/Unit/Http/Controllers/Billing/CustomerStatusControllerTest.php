<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\CustomerStatusController;
use App\Models\Eloquent\Billing\CustomerStatus\CustomerStatus;
use App\Http\Resources\Billing\CustomerStatus\CustomerStatusCollection;

class CustomerStatusControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var CustomerStatusController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = CustomerStatusController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(CustomerStatus::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, CustomerStatusCollection::class, 2);
    }
}