<?php

namespace Tests\Unit\Http\Controllers\Classroom;

use App\Models\Eloquent\Classroom\Question\QuestionFilters;
use App\Http\Controllers\Classroom\QuestionController;
use App\Http\Requests\Classroom\Question\CreateQuestionRequest;
use App\Http\Requests\Classroom\Question\UpdateQuestionRequest;
use App\Http\Resources\Classroom\Question\QuestionCollection;
use App\Http\Resources\Classroom\Question\QuestionResource;
use App\Models\Eloquent\Classroom\Question\Question;
use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;

class QuestionControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var \App\Http\Controllers\Classroom\QuestionController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = QuestionController::class;

    public function test_index()
    {
        // Mocks Expects        
        $this->db
            ->shouldReceive('select')
            ->andReturn($this->makeMany(Question::class));
        
        // Method execution
        $collection = $this->controller->index(new QuestionFilters());
        
        // Assertions
        $this->assertCollectionResponse($collection, QuestionCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $question = $this->makeOne(Question::class);
        $requestMock = $this->mockRequest(CreateQuestionRequest::class);
        
        // Mocks Expects
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->once()->andReturn($question->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, QuestionResource::class, Question::class);
    }

    public function test_show()
    {
        // Data creation
        $question = $this->makeOne(Question::class);
        
        // Method execution
        $resource = $this->controller->show($question);
        
        // Assertions
        $this->assertResourceResponse($resource, QuestionResource::class, Question::class);
    }

    public function test_update()
    {
        // Data creation
        $newQuestion = $this->makeOne(Question::class);
        $requestMock = $this->mockRequest(UpdateQuestionRequest::class);
        $questionMock = $this->mockModel(Question::class);

        // Mocks Expects
        $requestMock->shouldReceive('validated')->once()->andReturn($newQuestion->toArray());
        $questionMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->update($requestMock, $questionMock);

        // Assertions
        $this->assertResourceResponse($resource, QuestionResource::class, Question::class);
    }

    public function test_reactivate()
    {
        // Data creation
        $questionMock = $this->mockModel(Question::class);
        
        // Mocks Expects
        $questionMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->reactivate($questionMock);

        // Assertions
        $this->assertResourceResponse($resource, QuestionResource::class, Question::class);
    }

    public function test_delete()
    {
        // Data creation
        $questionMock = $this->mockModel(Question::class);
        
        // Mocks Expects
        $questionMock->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($questionMock);

        // Assertions
        $this->assertResourceResponse($resource, QuestionResource::class, Question::class);
    }
    
}
