<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use App\Models\Eloquent\Billing\Employee\Employee;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\EmployeeController;
use App\Http\Resources\Billing\Employee\EmployeeResource;
use App\Models\Eloquent\Billing\Employee\EmployeeFilters;
use App\Http\Resources\Billing\Employee\EmployeeCollection;
use App\Http\Requests\Billing\Employee\CreateEmployeeRequest;
use App\Http\Requests\Billing\Employee\UpdateEmployeeRequest;

class EmployeeControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var EmployeeController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = EmployeeController::class;

    public function test_index()
    {
        // Mocks Expects
        $this->db->shouldReceive('select')->andReturn($this->makeMany(Employee::class)->toArray());

        // Method execution
        $collection = $this->controller->index(new EmployeeFilters);

        // Assertions
        $this->assertCollectionResponse($collection, EmployeeCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $requestMock = $this->mockRequest(CreateEmployeeRequest::class);
        $employee = $this->makeOne(Employee::class);

        // Mocks Expects
        $this->db->shouldReceive('insert')->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->andReturn($employee->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, EmployeeResource::class, Employee::class);
    }

    public function test_show()
    {
        // Data creation
        $employee = $this->makeOne(Employee::class);

        // Method execution
        $resource = $this->controller->show($employee);

        // Assertions
        $this->assertResourceResponse($resource, EmployeeResource::class, Employee::class);
    }

    public function test_update()
    {
        // Data creation
        $requestMock = $this->mockRequest(UpdateEmployeeRequest::class);
        $employee = $this->makeOne(Employee::class);
        $newEmployee = $this->makeOne(Employee::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);
        $requestMock->shouldReceive('validated')->andReturn($newEmployee->toArray());

        // Method execution
        $resource = $this->controller->update($requestMock, $employee);

        // Assertions
        $this->assertResourceResponse($resource, EmployeeResource::class, Employee::class);
    }

    public function test_cancel()
    {
        // Data creation
        $employee = $this->makeOne(Employee::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($employee);

        // Assertions
        $this->assertResourceResponse($resource, EmployeeResource::class, Employee::class);
    }
}