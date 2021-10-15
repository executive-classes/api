<?php

namespace Tests\Unit\Http\Controllers\Classroom;

use App\Models\Eloquent\Classroom\Material\MaterialFilters;
use App\Http\Controllers\Classroom\MaterialController;
use App\Http\Requests\Classroom\Material\CreateMaterialRequest;
use App\Http\Requests\Classroom\Material\UpdateMaterialRequest;
use App\Http\Resources\Classroom\Material\MaterialCollection;
use App\Http\Resources\Classroom\Material\MaterialResource;
use App\Models\Eloquent\Classroom\Material\Material;
use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;

class MaterialControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var \App\Http\Controllers\Classroom\MaterialController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = MaterialController::class;

    public function test_index()
    {
        // Mocks Expects        
        $this->db
            ->shouldReceive('select')
            ->andReturn($this->makeMany(Material::class));
        
        // Method execution
        $collection = $this->controller->index(new MaterialFilters());
        
        // Assertions
        $this->assertCollectionResponse($collection, MaterialCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $material = $this->makeOne(Material::class);
        $requestMock = $this->mockRequest(CreateMaterialRequest::class);
        
        // Mocks Expects
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->once()->andReturn($material->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, MaterialResource::class, Material::class);
    }

    public function test_show()
    {
        // Data creation
        $material = $this->makeOne(Material::class);
        
        // Method execution
        $resource = $this->controller->show($material);
        
        // Assertions
        $this->assertResourceResponse($resource, MaterialResource::class, Material::class);
    }

    public function test_update()
    {
        // Data creation
        $newMaterial = $this->makeOne(Material::class);
        $requestMock = $this->mockRequest(UpdateMaterialRequest::class);
        $materialMock = $this->mockModel(Material::class);

        // Mocks Expects
        $requestMock->shouldReceive('validated')->once()->andReturn($newMaterial->toArray());
        $materialMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->update($requestMock, $materialMock);

        // Assertions
        $this->assertResourceResponse($resource, MaterialResource::class, Material::class);
    }

    public function test_reactivate()
    {
        // Data creation
        $materialMock = $this->mockModel(Material::class);
        
        // Mocks Expects
        $materialMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->reactivate($materialMock);

        // Assertions
        $this->assertResourceResponse($resource, MaterialResource::class, Material::class);
    }

    public function test_delete()
    {
        // Data creation
        $materialMock = $this->mockModel(Material::class);
        
        // Mocks Expects
        $materialMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($materialMock);

        // Assertions
        $this->assertResourceResponse($resource, MaterialResource::class, Material::class);
    }
    
}
