<?php

namespace Tests\Unit\Http\Controllers\General;

use App\Filters\General\CategoryFilter;
use App\Http\Controllers\General\CategoryController;
use App\Http\Requests\General\Category\CreateCategoryRequest;
use App\Http\Requests\General\Category\UpdateCategoryRequest;
use App\Http\Resources\General\Category\CategoryCollection;
use App\Http\Resources\General\Category\CategoryResource;
use App\Models\General\Category;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\Providers\Classroom\CourseProvider;
use Tests\Unit\Http\Controllers\ControllerTestCase;

class CourseControllerTest extends ControllerTestCase
{
    use CourseProvider;

    /**
     * @var \App\Http\Controllers\General\CategoryController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = CategoryController::class;

    public function test_index_returns_json_list()
    {
        $this->db->shouldReceive('select')
            ->andReturn($this->courses(3));

        $collection = $this->controller->index(new CategoryFilter());

        $this->assertInstanceOf(CategoryCollection::class, $collection);
        $this->assertCount(3, $collection);
    }

    public function test_store_returns_json()
    {
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);

        $category = $this->category();

        $requestMock = $this->mockRequest(CreateCategoryRequest::class);
        $requestMock->shouldReceive('validated')->once()->andReturn($category->toArray());

        $resource = $this->controller->store($requestMock);

        $this->assertInstanceOf(CategoryResource::class, $resource);
        $this->assertEquals($resource->resource->name, $category->name);
    }

    public function test_show_returns_json_item()
    {
        $category = $this->category();
        $resource = $this->controller->show($category);

        $this->assertInstanceOf(CategoryResource::class, $resource);
        $this->assertEquals($resource->resource->name, $category->name);
    }

    public function test_update_returns_json()
    {
        $newCategory = $this->category();

        $requestMock = $this->mockRequest(UpdateCategoryRequest::class);
        $requestMock->shouldReceive('validated')->once()->andReturn($newCategory->toArray());

        $categoryMock = $this->mockModel(Category::class);
        $categoryMock->shouldReceive('update')->andReturn(true);

        $resource = $this->controller->update($requestMock, $categoryMock);

        $this->assertInstanceOf(CategoryResource::class, $resource);
    }

    public function test_delete_returns_no_content_response()
    {
        $categoryMock = $this->mockModel(Category::class);
        $categoryMock->shouldReceive('delete')->andReturn(true);

        $response = $this->controller->delete($categoryMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
    }
}
