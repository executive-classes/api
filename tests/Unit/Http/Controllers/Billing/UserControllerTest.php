<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use App\Models\Eloquent\Billing\User\User;
use App\Http\Controllers\Billing\UserController;
use App\Http\Resources\Billing\User\UserResource;
use App\Models\Eloquent\Billing\User\UserFilters;
use App\Http\Resources\Billing\User\UserCollection;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Requests\Billing\User\CreateUserRequest;
use App\Http\Requests\Billing\User\UpdateUserRequest;

class UserControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var UserController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = UserController::class;

    public function test_index()
    {
        // Mocks Expects
        $this->db->shouldReceive('select')->andReturn($this->makeMany(User::class)->toArray());

        // Method execution
        $collection = $this->controller->index(new UserFilters);

        // Assertions
        $this->assertCollectionResponse($collection, UserCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $requestMock = $this->mockRequest(CreateUserRequest::class);
        $user = $this->makeOne(User::class);

        // Mocks Expects
        $this->db->shouldReceive('insert')->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->andReturn($user->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, UserResource::class, User::class);
    }

    public function test_show()
    {
        // Data creation
        $user = $this->makeOne(User::class);

        // Method execution
        $resource = $this->controller->show($user);

        // Assertions
        $this->assertResourceResponse($resource, UserResource::class, User::class);
    }

    public function test_update()
    {
        // Data creation
        $requestMock = $this->mockRequest(UpdateUserRequest::class);
        $user = $this->makeOne(User::class);
        $newUser = $this->makeOne(User::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);
        $requestMock->shouldReceive('validated')->andReturn($newUser->toArray());

        // Method execution
        $resource = $this->controller->update($requestMock, $user);

        // Assertions
        $this->assertResourceResponse($resource, UserResource::class, User::class);
    }

    public function test_cancel()
    {
        // Data creation
        $user = $this->makeOne(User::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($user);

        // Assertions
        $this->assertResourceResponse($resource, UserResource::class, User::class);
    }
}