<?php

namespace Tests\Unit\Http\Controllers\Classroom;

use App\Models\Eloquent\Classroom\Course\CourseFilters;
use App\Http\Controllers\Classroom\CourseController;
use App\Http\Requests\Classroom\Course\CreateCourseRequest;
use App\Http\Requests\Classroom\Course\UpdateCourseRequest;
use App\Http\Resources\Classroom\Course\CourseCollection;
use App\Http\Resources\Classroom\Course\CourseResource;
use App\Models\Eloquent\Classroom\Course\Course;
use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;

class CourseControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var \App\Http\Controllers\Classroom\CourseController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = CourseController::class;

    public function test_index_returns_json_list()
    {
        $this->db->shouldReceive('select')
            ->andReturn($this->makeMany(Course::class));

        $collection = $this->controller->index(new CourseFilters());

        $this->assertInstanceOf(CourseCollection::class, $collection);
        $this->assertCount(2, $collection);
    }

    public function test_store_returns_json()
    {
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);

        $course = $this->makeOne(Course::class);

        $requestMock = $this->mockRequest(CreateCourseRequest::class);
        $requestMock->shouldReceive('validated')->once()->andReturn($course->toArray());

        $resource = $this->controller->store($requestMock);

        $this->assertInstanceOf(CourseResource::class, $resource);
        $this->assertEquals($resource->resource->name, $course->name);
    }

    public function test_show_returns_json_item()
    {
        $course = $this->makeOne(Course::class);
        $resource = $this->controller->show($course);

        $this->assertInstanceOf(CourseResource::class, $resource);
        $this->assertEquals($resource->resource->name, $course->name);
    }

    public function test_update_returns_json()
    {
        $newCourse = $this->makeOne(Course::class);

        $requestMock = $this->mockRequest(UpdateCourseRequest::class);
        $requestMock->shouldReceive('validated')->once()->andReturn($newCourse->toArray());

        $courseMock = $this->mockModel(Course::class);
        $courseMock->shouldReceive('update')->andReturn(true);

        $resource = $this->controller->update($requestMock, $courseMock);

        $this->assertInstanceOf(CourseResource::class, $resource);
    }

    public function test_reactivate_returns_json_item()
    {
        $courseMock = $this->mockModel(Course::class);
        $courseMock->shouldReceive('update')->andReturn(true);

        $resource = $this->controller->reactivate($courseMock);

        $this->assertInstanceOf(CourseResource::class, $resource);
    }

    public function test_cancel_returns_json_item()
    {
        $courseMock = $this->mockModel(Course::class);
        $courseMock->shouldReceive('update')->andReturn(true);

        $resource = $this->controller->cancel($courseMock);

        $this->assertInstanceOf(CourseResource::class, $resource);
    }
    
}
