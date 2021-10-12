<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\EmployeePositionController;
use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;
use App\Http\Resources\Billing\EmployeePosition\EmployeePositionCollection;

class EmployeePositionControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var EmployeePositionController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = EmployeePositionController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(EmployeePosition::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, EmployeePositionCollection::class, 2);
    }
}