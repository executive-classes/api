<?php

namespace Tests\Unit\Http\Controllers\Mailing;

use Mockery;
use Tests\FactoryMaker;
use Illuminate\Http\Request;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Mailing\MessageTemplateController;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplateRepository;
use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateCreateRequest;
use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateUpdateRequest;

class MessageTemplateControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var MessageTemplateController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = MessageTemplateController::class;

    /**
     * Set the controller constructor parameters.
     *
     * @return void
     */
    protected function setParameters()
    {
        $this->controllerParameters = [
            'messageTemplateRepository' => $this->makeMock(
                MessageTemplateRepository::class,
                '[list,create,update,delete]',
                [new MessageTemplate]
            )
        ];
    }

    public function test_list()
    {
        // Data creation
        $requestMock = $this->mockRequest(Request::class);
        $templates = $this->makeMany(MessageTemplate::class);

        // Mocks Expects
        $this->controllerParameters['messageTemplateRepository']
            ->shouldReceive('list')
            ->andReturn($templates);

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
        $template = $this->makeOne(MessageTemplate::class);
        
        // Method execution
        $response = $this->controller->show($requestMock, $template);
        
        // Assertions
        $this->assertJsonResponse($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $requestMock = $this->mockRequest(MessageTemplateCreateRequest::class);
        $template = $this->makeOne(MessageTemplate::class);

        // Mocks Expects
        $this->controllerParameters['messageTemplateRepository']
            ->shouldReceive('create')
            ->andReturn($template);
        $requestMock
            ->shouldReceive('validated')
            ->andReturn($template->toArray());
        
        // Method execution
        $response = $this->controller->create($requestMock);

        // Assertions
        $this->assertJsonResponse($response, 201);
    }

    public function test_update()
    {
        // Data creation
        $requestMock = $this->mockRequest(MessageTemplateUpdateRequest::class);
        $template = $this->makeOne(MessageTemplate::class);
        $newTemplate = $this->makeOne(MessageTemplate::class);

        // Mocks Expects
        $this->controllerParameters['messageTemplateRepository']
            ->shouldReceive('update')
            ->andReturn($newTemplate);
        $requestMock
            ->shouldReceive('validated')
            ->andReturn($newTemplate->toArray());
        
        // Method execution
        $response = $this->controller->update($requestMock, $template);

        // Assertions
        $this->assertJsonResponse($response, 200);
    }

    public function test_delete()
    {
        // Data creation
        $requestMock = $this->mockRequest(Request::class);
        $template = $this->makeOne(MessageTemplate::class);

        // Mocks Expects
        $this->controllerParameters['messageTemplateRepository']
            ->shouldReceive('delete');
        
        // Method execution
        $response = $this->controller->delete($requestMock, $template);

        // Assertions
        $this->assertJsonResponse($response, 204);
    }
}