<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use App\Models\Eloquent\Billing\Teacher\Teacher;
use App\Http\Controllers\Billing\TeacherController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Resources\Billing\Teacher\TeacherResource;
use App\Models\Eloquent\Billing\Teacher\TeacherFilters;
use App\Http\Resources\Billing\Teacher\TeacherCollection;
use App\Http\Requests\Billing\Teacher\CreateTeacherRequest;
use App\Http\Requests\Billing\Teacher\UpdateTeacherRequest;

class TeacherControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var TeacherController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = TeacherController::class;

    public function test_index()
    {
        // Mocks Expects
        $this->db->shouldReceive('select')->andReturn($this->makeMany(Teacher::class)->toArray());

        // Method execution
        $collection = $this->controller->index(new TeacherFilters);

        // Assertions
        $this->assertCollectionResponse($collection, TeacherCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $requestMock = $this->mockRequest(CreateTeacherRequest::class);
        $teacher = $this->makeOne(Teacher::class);

        // Mocks Expects
        $this->db->shouldReceive('insert')->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->andReturn($teacher->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, TeacherResource::class, Teacher::class);
    }

    public function test_show()
    {
        // Data creation
        $teacher = $this->makeOne(Teacher::class);

        // Method execution
        $resource = $this->controller->show($teacher);

        // Assertions
        $this->assertResourceResponse($resource, TeacherResource::class, Teacher::class);
    }

    public function test_update()
    {
        // Data creation
        $requestMock = $this->mockRequest(UpdateTeacherRequest::class);
        $teacher = $this->makeOne(Teacher::class);
        $newTeacher = $this->makeOne(Teacher::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);
        $requestMock->shouldReceive('validated')->andReturn($newTeacher->toArray());

        // Method execution
        $resource = $this->controller->update($requestMock, $teacher);

        // Assertions
        $this->assertResourceResponse($resource, TeacherResource::class, Teacher::class);
    }

    public function test_cancel()
    {
        // Data creation
        $teacher = $this->makeOne(Teacher::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($teacher);

        // Assertions
        $this->assertResourceResponse($resource, TeacherResource::class, Teacher::class);
    }
}