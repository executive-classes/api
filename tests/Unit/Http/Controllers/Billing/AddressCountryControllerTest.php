<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\AddressCountryController;
use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;
use App\Http\Resources\Billing\AddressCountry\AddressCountryCollection;

class AddressCountryControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var AddressCountryController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = AddressCountryController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(AddressCountry::class));
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, AddressCountryCollection::class, 2);
    }
}