<?php

namespace Tests\Unit\Http\Controllers\General;

use App\Models\Eloquent\General\Category\CategoryFilters;
use App\Http\Controllers\General\CategoryController;
use App\Http\Requests\General\Category\CreateCategoryRequest;
use App\Http\Requests\General\Category\UpdateCategoryRequest;
use App\Http\Resources\General\Category\CategoryCollection;
use App\Http\Resources\General\Category\CategoryResource;
use App\Models\Eloquent\General\Category\Category;
use Illuminate\Http\JsonResponse;
use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;

class CategoryControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var \App\Http\Controllers\General\CategoryController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = CategoryController::class;

    public function test_index()
    {
        // Mocks Expects
        $this->db->shouldReceive('select')->andReturn($this->makeMany(Category::class));
        
        // Method execution
        $collection = $this->controller->index(new CategoryFilters());
        
        // Assertions
        $this->assertCollectionResponse($collection, CategoryCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $category = $this->makeOne(Category::class);
        $requestMock = $this->mockRequest(CreateCategoryRequest::class);
        
        // Mocks Expects
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->once()->andReturn($category->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, CategoryResource::class, Category::class);
    }

    public function test_show()
    {
        // Data creation
        $category = $this->makeOne(Category::class);
        
        // Method execution
        $resource = $this->controller->show($category);
        
        // Assertions
        $this->assertResourceResponse($resource, CategoryResource::class, Category::class);
    }

    public function test_update()
    {
        // Data creation
        $newCategory = $this->makeOne(Category::class);
        $requestMock = $this->mockRequest(UpdateCategoryRequest::class);
        $categoryMock = $this->mockModel(Category::class);

        // Mocks Expects
        $requestMock->shouldReceive('validated')->once()->andReturn($newCategory->toArray());
        $categoryMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->update($requestMock, $categoryMock);

        // Assertions
        $this->assertResourceResponse($resource, CategoryResource::class, Category::class);
    }

    public function test_delete()
    {
        // Data creation
        $categoryMock = $this->mockModel(Category::class);

        // Mocks Expects
        $categoryMock->shouldReceive('delete')->andReturn(true);

        // Method execution
        $response = $this->controller->delete($categoryMock);

        // Assertions
        $this->assertJsonResponse($response, 204);
    }
}
