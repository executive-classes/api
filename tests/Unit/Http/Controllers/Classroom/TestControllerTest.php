<?php

namespace Tests\Unit\Http\Controllers\Classroom;

use App\Models\Eloquent\Classroom\Test\TestFilters;
use App\Http\Controllers\Classroom\TestController;
use App\Http\Requests\Classroom\Test\CreateTestRequest;
use App\Http\Requests\Classroom\Test\UpdateTestRequest;
use App\Http\Resources\Classroom\Test\TestCollection;
use App\Http\Resources\Classroom\Test\TestResource;
use App\Models\Eloquent\Classroom\Test\Test;
use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;

class TestControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var \App\Http\Controllers\Classroom\TestController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = TestController::class;

    public function test_index()
    {
        // Mocks Expects        
        $this->db
            ->shouldReceive('select')
            ->andReturn($this->makeMany(Test::class));
        
        // Method execution
        $collection = $this->controller->index(new TestFilters());
        
        // Assertions
        $this->assertCollectionResponse($collection, TestCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $test = $this->makeOne(Test::class);
        $requestMock = $this->mockRequest(CreateTestRequest::class);
        
        // Mocks Expects
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->once()->andReturn($test->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, TestResource::class, Test::class);
    }

    public function test_show()
    {
        // Data creation
        $test = $this->makeOne(Test::class);
        
        // Method execution
        $resource = $this->controller->show($test);
        
        // Assertions
        $this->assertResourceResponse($resource, TestResource::class, Test::class);
    }

    public function test_update()
    {
        // Data creation
        $newTest = $this->makeOne(Test::class);
        $requestMock = $this->mockRequest(UpdateTestRequest::class);
        $testMock = $this->mockModel(Test::class);

        // Mocks Expects
        $requestMock->shouldReceive('validated')->once()->andReturn($newTest->toArray());
        $testMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->update($requestMock, $testMock);

        // Assertions
        $this->assertResourceResponse($resource, TestResource::class, Test::class);
    }

    public function test_reactivate()
    {
        // Data creation
        $testMock = $this->mockModel(Test::class);
        
        // Mocks Expects
        $testMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->reactivate($testMock);

        // Assertions
        $this->assertResourceResponse($resource, TestResource::class, Test::class);
    }

    public function test_delete()
    {
        // Data creation
        $testMock = $this->mockModel(Test::class);
        
        // Mocks Expects
        $testMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($testMock);

        // Assertions
        $this->assertResourceResponse($resource, TestResource::class, Test::class);
    }
    
}
