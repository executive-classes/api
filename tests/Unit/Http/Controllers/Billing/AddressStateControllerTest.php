<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\AddressStateController;
use App\Models\Eloquent\Billing\AddressState\AddressState;
use App\Http\Resources\Billing\AddressState\AddressStateCollection;

class AddressStateControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var AddressStateController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = AddressStateController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(AddressState::class));
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, AddressStateCollection::class, 2);
    }
}