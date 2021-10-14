<?php

namespace Tests\Unit\Http\Controllers\Classroom;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Classroom\LessonController;
use App\Http\Requests\Classroom\Lesson\CreateLessonRequest;
use App\Http\Requests\Classroom\Lesson\UpdateLessonRequest;
use App\Http\Resources\Classroom\Lesson\LessonCollection;
use App\Http\Resources\Classroom\Lesson\LessonResource;
use App\Models\Eloquent\Classroom\Lesson\Lesson;
use App\Models\Eloquent\Classroom\Lesson\LessonFilters;

class LessonControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var \App\Http\Controllers\Classroom\LessonController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = LessonController::class;

    public function test_index()
    {
        // Mocks Expects        
        $this->db
            ->shouldReceive('select')
            ->andReturn($this->makeMany(Lesson::class));
        
        // Method execution
        $collection = $this->controller->index(new LessonFilters());
        
        // Assertions
        $this->assertCollectionResponse($collection, LessonCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $lesson = $this->makeOne(Lesson::class);
        $requestMock = $this->mockRequest(CreateLessonRequest::class);
        
        // Mocks Expects
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->once()->andReturn($lesson->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, LessonResource::class, Lesson::class);
    }

    public function test_show()
    {
        // Data creation
        $lesson = $this->makeOne(Lesson::class);
        
        // Method execution
        $resource = $this->controller->show($lesson);
        
        // Assertions
        $this->assertResourceResponse($resource, LessonResource::class, Lesson::class);
    }

    public function test_update()
    {
        // Data creation
        $newLesson = $this->makeOne(Lesson::class);
        $requestMock = $this->mockRequest(UpdateLessonRequest::class);
        $lessonMock = $this->mockModel(Lesson::class);

        // Mocks Expects
        $requestMock->shouldReceive('validated')->once()->andReturn($newLesson->toArray());
        $lessonMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->update($requestMock, $lessonMock);

        // Assertions
        $this->assertResourceResponse($resource, LessonResource::class, Lesson::class);
    }

    public function test_reactivate()
    {
        // Data creation
        $lessonMock = $this->mockModel(Lesson::class);
        
        // Mocks Expects
        $lessonMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->reactivate($lessonMock);

        // Assertions
        $this->assertResourceResponse($resource, LessonResource::class, Lesson::class);
    }

    public function test_delete()
    {
        // Data creation
        $lessonMock = $this->mockModel(Lesson::class);
        
        // Mocks Expects
        $lessonMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($lessonMock);

        // Assertions
        $this->assertResourceResponse($resource, LessonResource::class, Lesson::class);
    }
    
}
