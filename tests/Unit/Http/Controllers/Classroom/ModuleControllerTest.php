<?php

namespace Tests\Unit\Http\Controllers\Classroom;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Classroom\ModuleController;
use App\Http\Requests\Classroom\Module\CreateModuleRequest;
use App\Http\Requests\Classroom\Module\UpdateModuleRequest;
use App\Http\Resources\Classroom\Module\ModuleCollection;
use App\Http\Resources\Classroom\Module\ModuleResource;
use App\Models\Eloquent\Classroom\Module\Module;
use App\Models\Eloquent\Classroom\Module\ModuleFilters;

class ModuleControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var \App\Http\Controllers\Classroom\ModuleController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = ModuleController::class;

    public function test_index()
    {
        // Mocks Expects        
        $this->db
            ->shouldReceive('select')
            ->andReturn($this->makeMany(Module::class));
        
        // Method execution
        $collection = $this->controller->index(new ModuleFilters());
        
        // Assertions
        $this->assertCollectionResponse($collection, ModuleCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $module = $this->makeOne(Module::class);
        $requestMock = $this->mockRequest(CreateModuleRequest::class);
        
        // Mocks Expects
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->once()->andReturn($module->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, ModuleResource::class, Module::class);
    }

    public function test_show()
    {
        // Data creation
        $module = $this->makeOne(Module::class);
        
        // Method execution
        $resource = $this->controller->show($module);
        
        // Assertions
        $this->assertResourceResponse($resource, ModuleResource::class, Module::class);
    }

    public function test_update()
    {
        // Data creation
        $newModule = $this->makeOne(Module::class);
        $requestMock = $this->mockRequest(UpdateModuleRequest::class);
        $moduleMock = $this->mockModel(Module::class);

        // Mocks Expects
        $requestMock->shouldReceive('validated')->once()->andReturn($newModule->toArray());
        $moduleMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->update($requestMock, $moduleMock);

        // Assertions
        $this->assertResourceResponse($resource, ModuleResource::class, Module::class);
    }

    public function test_reactivate()
    {
        // Data creation
        $moduleMock = $this->mockModel(Module::class);
        
        // Mocks Expects
        $moduleMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->reactivate($moduleMock);

        // Assertions
        $this->assertResourceResponse($resource, ModuleResource::class, Module::class);
    }

    public function test_delete()
    {
        // Data creation
        $moduleMock = $this->mockModel(Module::class);
        
        // Mocks Expects
        $moduleMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($moduleMock);

        // Assertions
        $this->assertResourceResponse($resource, ModuleResource::class, Module::class);
    }
    
}
