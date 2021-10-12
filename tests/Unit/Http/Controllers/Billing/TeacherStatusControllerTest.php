<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\TeacherStatusController;
use App\Models\Eloquent\Billing\TeacherStatus\TeacherStatus;
use App\Http\Resources\Billing\TeacherStatus\TeacherStatusCollection;

class TeacherStatusControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var TeacherStatusController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = TeacherStatusController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(TeacherStatus::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, TeacherStatusCollection::class, 2);
    }
}