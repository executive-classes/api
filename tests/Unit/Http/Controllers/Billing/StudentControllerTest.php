<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use App\Models\Eloquent\Billing\Student\Student;
use App\Http\Controllers\Billing\StudentController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Resources\Billing\Student\StudentResource;
use App\Models\Eloquent\Billing\Student\StudentFilters;
use App\Http\Resources\Billing\Student\StudentCollection;
use App\Http\Requests\Billing\Student\CreateStudentRequest;
use App\Http\Requests\Billing\Student\UpdateStudentRequest;

class StudentControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var StudentController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = StudentController::class;

    public function test_index()
    {
        // Mocks Expects
        $this->db->shouldReceive('select')->andReturn($this->makeMany(Student::class)->toArray());

        // Method execution
        $collection = $this->controller->index(new StudentFilters);

        // Assertions
        $this->assertCollectionResponse($collection, StudentCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $requestMock = $this->mockRequest(CreateStudentRequest::class);
        $student = $this->makeOne(Student::class);

        // Mocks Expects
        $this->db->shouldReceive('insert')->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->andReturn($student->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, StudentResource::class, Student::class);
    }

    public function test_show()
    {
        // Data creation
        $student = $this->makeOne(Student::class);

        // Method execution
        $resource = $this->controller->show($student);

        // Assertions
        $this->assertResourceResponse($resource, StudentResource::class, Student::class);
    }

    public function test_update()
    {
        // Data creation
        $requestMock = $this->mockRequest(UpdateStudentRequest::class);
        $student = $this->makeOne(Student::class);
        $newStudent = $this->makeOne(Student::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);
        $requestMock->shouldReceive('validated')->andReturn($newStudent->toArray());

        // Method execution
        $resource = $this->controller->update($requestMock, $student);

        // Assertions
        $this->assertResourceResponse($resource, StudentResource::class, Student::class);
    }

    public function test_cancel()
    {
        // Data creation
        $student = $this->makeOne(Student::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($student);

        // Assertions
        $this->assertResourceResponse($resource, StudentResource::class, Student::class);
    }
}