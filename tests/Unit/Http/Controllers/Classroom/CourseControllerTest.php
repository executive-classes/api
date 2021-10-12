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

    public function test_index()
    {
        // Mocks Expects        
        $this->db
            ->shouldReceive('select')
            ->andReturn($this->makeMany(Course::class));
        
        // Method execution
        $collection = $this->controller->index(new CourseFilters());
        
        // Assertions
        $this->assertCollectionResponse($collection, CourseCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $course = $this->makeOne(Course::class);
        $requestMock = $this->mockRequest(CreateCourseRequest::class);
        
        // Mocks Expects
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->once()->andReturn($course->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, CourseResource::class, Course::class);
    }

    public function test_show()
    {
        // Data creation
        $course = $this->makeOne(Course::class);
        
        // Method execution
        $resource = $this->controller->show($course);
        
        // Assertions
        $this->assertResourceResponse($resource, CourseResource::class, Course::class);
    }

    public function test_update()
    {
        // Data creation
        $newCourse = $this->makeOne(Course::class);
        $requestMock = $this->mockRequest(UpdateCourseRequest::class);
        $courseMock = $this->mockModel(Course::class);

        // Mocks Expects
        $requestMock->shouldReceive('validated')->once()->andReturn($newCourse->toArray());
        $courseMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->update($requestMock, $courseMock);

        // Assertions
        $this->assertResourceResponse($resource, CourseResource::class, Course::class);
    }

    public function test_reactivate()
    {
        // Data creation
        $courseMock = $this->mockModel(Course::class);
        
        // Mocks Expects
        $courseMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->reactivate($courseMock);

        // Assertions
        $this->assertResourceResponse($resource, CourseResource::class, Course::class);
    }

    public function test_delete()
    {
        // Data creation
        $courseMock = $this->mockModel(Course::class);
        
        // Mocks Expects
        $courseMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($courseMock);

        // Assertions
        $this->assertResourceResponse($resource, CourseResource::class, Course::class);
    }
    
}
