<?php

use Tests\FactoryMaker;
use App\Http\Requests\Request;
use Illuminate\Http\JsonResponse;
use Tests\Providers\Auth\TokenProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Eloquent\Billing\User\User;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Requests\Auth\CrossLoginRequest;
use Tests\Providers\Auth\AccessTokenProvider;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Resources\Auth\AccessToken\TokenResource;

class AuthenticateControllerTest extends ControllerTestCase
{
    use FactoryMaker;
    use TokenProvider;
    use AccessTokenProvider;
    use WithFaker;
    
    /**
     * @var AuthenticateController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = AuthenticateController::class;

    /**
     * Set the controller constructor parameters.
     *
     * @return void
     */
    protected function setParameters()
    {
        $this->controllerParameters = [
            'user' => Mockery::mock(User::class . '[find,firstWhere,check,login,crossLogin,currentAccessToken]')
        ];
    }

    public function test_login()
    {
        // Data creation
        $requestMock = $this->mockRequest(LoginRequest::class);
        $requestMock->password = config('test.user.password');

        // Mocks Expects
        $this->controllerParameters['user']
            ->shouldReceive('firstWhere')
            ->andReturn($this->controllerParameters['user']);
        $this->controllerParameters['user']
            ->shouldReceive('check')
            ->andReturn(true);
        $this->controllerParameters['user']
            ->shouldReceive('login')
            ->andReturn($this->makeOneNewAccessToken());
        $requestMock
            ->shouldReceive('get')
            ->with('remember_me', false)
            ->andReturn(false);

        // Method execution
        $resource = $this->controller->login($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, TokenResource::class);
    }

    public function test_login_with_remember_me()
    {
        // Data creation
        $requestMock = $this->mockRequest(LoginRequest::class);
        $requestMock->password = config('test.user.password');

        // Mocks Expects
        $this->db->shouldReceive('insert')->once()->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $this->controllerParameters['user']
            ->shouldReceive('firstWhere')
            ->andReturn($this->controllerParameters['user']);
        $this->controllerParameters['user']
            ->shouldReceive('check')
            ->andReturn(true);
        $this->controllerParameters['user']
            ->shouldReceive('login')
            ->andReturn($this->makeOneNewAccessToken());
        $requestMock
            ->shouldReceive('get')
            ->with('remember_me', false)
            ->andReturn(true);

        // Method execution
        $resource = $this->controller->login($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, TokenResource::class);
    }

    public function test_login_inactive()
    {
        // Data creation
        $requestMock = $this->mockRequest(LoginRequest::class);
        $user = $this->makeOne(User::class);
        $user->active = false;

        // Mocks Expects
        $this->controllerParameters['user']
            ->shouldReceive('firstWhere')
            ->andReturn($user);

        // Method execution
        $response = $this->controller->login($requestMock);

        // Assertions
        $this->assertJsonResponse($response, 403);
        $this->assertEquals(__('auth.inactive'), $response->getData()->message);
    }

    public function test_login_wrong_password()
    {
        // Data creation
        $requestMock = $this->mockRequest(LoginRequest::class);
        $requestMock->password = 'Wrong Password';

        // Mocks Expects
        $this->controllerParameters['user']
            ->shouldReceive('firstWhere')
            ->andReturn($this->controllerParameters['user']);
        $this->controllerParameters['user']
            ->shouldReceive('check')
            ->andReturn(false);

        // Method execution
        $response = $this->controller->login($requestMock);

        // Assertions
        $this->assertJsonResponse($response, 400);
        $this->assertEquals(__('auth.password'), $response->getData()->message);
    }

    public function test_crossLogin()
    {
        // Data creation
        $requestMock = $this->mockRequest(CrossLoginRequest::class, '[user]');

        // Mocks Expects
        $this->controllerParameters['user']
            ->shouldReceive('find')
            ->andReturn($this->controllerParameters['user']);
        $this->controllerParameters['user']
            ->shouldReceive('crossLogin')
            ->andReturn($this->makeOneNewAccessToken());
        $requestMock
            ->shouldReceive('user')
            ->andReturn($this->controllerParameters['user']);

        // Method execution
        $resource = $this->controller->crossLogin($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, TokenResource::class);
    }

    public function test_crossLogin_inactive()
    {
        // Data creation
        $user = $this->makeOne(User::class);
        $user->active = false;
        $requestMock = $this->mockRequest(CrossLoginRequest::class, '[user]');

        // Mocks Expects
        $this->controllerParameters['user']
            ->shouldReceive('find')
            ->andReturn($user);

        // Method execution
        $response = $this->controller->crossLogin($requestMock);

        // Assertions
        $this->assertJsonResponse($response, 403);
        $this->assertEquals(__('auth.inactive'), $response->getData()->message);
    }

    public function test_token()
    {
        // Data creation
        $requestMock = $this->mockRequest(Request::class, '[user,bearerToken]');

        // Mocks Expects
        $this->controllerParameters['user']
            ->shouldReceive('currentAccessToken')
            ->andReturn($this->makeOneAccessToken());
        $requestMock
            ->shouldReceive('user')
            ->andReturn($this->controllerParameters['user']);
        $requestMock
            ->shouldReceive('bearerToken')
            ->andReturn($this->faker()->text(64));

        // Method execution
        $resource = $this->controller->token($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, TokenResource::class);
    }

    public function test_logout()
    {
        // Data creation
        $requestMock = $this->mockRequest(Request::class, '[user]');

        // Mocks Expects
        $requestMock
            ->shouldReceive('user')
            ->andReturn($this->controllerParameters['user']);

        // Method execution
        $response = $this->controller->logout($requestMock);

        // Assertions
        $this->assertJsonResponse($response, 204);
    }
}