<?php

namespace Tests\Unit\Http\Controllers\Mailing;

use Mockery;
use Tests\FactoryMaker;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Eloquent\Mailing\Message\Message;
use App\Http\Controllers\Mailing\MessageController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Models\Eloquent\Mailing\Message\MessageRepository;
use App\Http\Requests\Mailing\Message\MessageCreateRequest;

class MessageControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var MessageController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = MessageController::class;

    /**
     * Set the controller constructor parameters.
     *
     * @return void
     */
    protected function setParameters()
    {
        $this->controllerParameters = [
            'messageRepository' => $this->makeMock(
                MessageRepository::class, 
                '[list,create,cancelScheduledMessage]',
                [new Message]
            )
        ];
    }

    public function test_list()
    {
        // Data creation
        $requestMock = $this->mockRequest(Request::class);
        $messages = $this->makeMany(Message::class);

        // Mocks Expects
        $this->controllerParameters['messageRepository']
            ->shouldReceive('list')
            ->andReturn($messages);

        // Method execution
        $response = $this->controller->list($requestMock);

        // Assertions
        $this->assertJsonResponse($response, 200);
        $this->assertCount(2, $response->getData()->data);
    }

    public function test_show()
    {
        // Data creation
        $requestMock = $this->mockRequest(Request::class);
        $message = $this->makeOne(Message::class);
        
        // Method execution
        $response = $this->controller->show($requestMock, $message);
        
        // Assertions
        $this->assertJsonResponse($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $requestMock = $this->mockRequest(MessageCreateRequest::class);
        $message = $this->makeOne(Message::class);

        // Mocks Expects
        $this->controllerParameters['messageRepository']
            ->shouldReceive('create')
            ->andReturn($message);
        $requestMock
            ->shouldReceive('validated')
            ->andReturn($message->toArray());
        
        // Method execution
        $response = $this->controller->create($requestMock);

        // Assertions
        $this->assertJsonResponse($response, 201);
    }

    public function test_cancel()
    {
        // Data creation
        $requestMock = $this->mockRequest(Request::class);
        $message = $this->makeOne(Message::class);

        // Mocks Expects
        $this->controllerParameters['messageRepository']
            ->shouldReceive('cancelScheduledMessage');
        
        // Method execution
        $response = $this->controller->cancel($requestMock, $message);

        // Assertions
        $this->assertJsonResponse($response, 204);
    }
}