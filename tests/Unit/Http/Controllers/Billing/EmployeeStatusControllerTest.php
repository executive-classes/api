<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\EmployeeStatusController;
use App\Models\Eloquent\Billing\EmployeeStatus\EmployeeStatus;
use App\Http\Resources\Billing\EmployeeStatus\EmployeeStatusCollection;

class EmployeeStatusControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var EmployeeStatusController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = EmployeeStatusController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(EmployeeStatus::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, EmployeeStatusCollection::class, 2);
    }
}