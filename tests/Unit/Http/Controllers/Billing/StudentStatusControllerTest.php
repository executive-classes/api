<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\StudentStatusController;
use App\Models\Eloquent\Billing\StudentStatus\StudentStatus;
use App\Http\Resources\Billing\StudentStatus\StudentStatusCollection;

class StudentStatusControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var StudentStatusController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = StudentStatusController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(StudentStatus::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, StudentStatusCollection::class, 2);
    }
}