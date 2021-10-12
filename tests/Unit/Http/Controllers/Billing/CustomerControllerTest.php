<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use App\Models\Eloquent\Billing\Customer\Customer;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\CustomerController;
use App\Http\Resources\Billing\Customer\CustomerResource;
use App\Models\Eloquent\Billing\Customer\CustomerFilters;
use App\Http\Resources\Billing\Customer\CustomerCollection;
use App\Http\Requests\Billing\Customer\CreateCustomerRequest;
use App\Http\Requests\Billing\Customer\UpdateCustomerRequest;

class CustomerControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var CustomerController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = CustomerController::class;

    public function test_index()
    {
        // Mocks Expects
        $this->db->shouldReceive('select')->andReturn($this->makeMany(Customer::class)->toArray());

        // Method execution
        $collection = $this->controller->index(new CustomerFilters);

        // Assertions
        $this->assertCollectionResponse($collection, CustomerCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $requestMock = $this->mockRequest(CreateCustomerRequest::class);
        $customer = $this->makeOne(Customer::class);

        // Mocks Expects
        $this->db->shouldReceive('insert')->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->andReturn($customer->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, CustomerResource::class, Customer::class);
    }

    public function test_show()
    {
        // Data creation
        $customer = $this->makeOne(Customer::class);

        // Method execution
        $resource = $this->controller->show($customer);

        // Assertions
        $this->assertResourceResponse($resource, CustomerResource::class, Customer::class);
    }

    public function test_update()
    {
        // Data creation
        $requestMock = $this->mockRequest(UpdateCustomerRequest::class);
        $customer = $this->makeOne(Customer::class);
        $newCustomer = $this->makeOne(Customer::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);
        $requestMock->shouldReceive('validated')->andReturn($newCustomer->toArray());

        // Method execution
        $resource = $this->controller->update($requestMock, $customer);

        // Assertions
        $this->assertResourceResponse($resource, CustomerResource::class, Customer::class);
    }

    public function test_cancel()
    {
        // Data creation
        $customer = $this->makeOne(Customer::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($customer);

        // Assertions
        $this->assertResourceResponse($resource, CustomerResource::class, Customer::class);
    }
}