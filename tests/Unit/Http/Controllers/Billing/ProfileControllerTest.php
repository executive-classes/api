<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Illuminate\Http\Request;
use App\Models\Eloquent\Billing\User\User;
use App\Http\Controllers\Billing\ProfileController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Resources\Billing\User\ProfileResource;
use App\Http\Requests\Billing\User\UpdateProfileRequest;

class ProfileControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var ProfileController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = ProfileController::class;

    /**
     * Set the controller constructor parameters.
     *
     * @return void
     */
    protected function setParameters()
    {
        $this->controllerParameters = [
            
        ];
    }

    public function test_index()
    {
        // Data creation
        $user = $this->makeOne(User::class);
        $requestMock = $this->mockRequest(Request::class, '[user]');

        // Mocks Expects   
        $requestMock->shouldReceive('user')->andReturn($user);

        // Method execution
        $resource = $this->controller->index($requestMock);
        
        // Assertions
        $this->assertResourceResponse($resource, ProfileResource::class, User::class);
    }

    public function test_update()
    {
        // Data creation
        $user = $this->makeOne(User::class);
        $modelMock = $this->mockModel(User::class);
        $requestMock = $this->mockRequest(UpdateProfileRequest::class);

        // Mocks Expects
        $requestMock->shouldReceive('user')->andReturn($modelMock);
        $requestMock->shouldReceive('validated')->once()->andReturn($user->toArray());
        $modelMock->shouldReceive('refresh')->andReturn($user);
        $modelMock->shouldReceive('update');

        // Method execution
        $resource = $this->controller->update($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, ProfileResource::class, User::class);
    }
}