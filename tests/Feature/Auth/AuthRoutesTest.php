<?php

namespace Tests\Feature\Auth;

use App\Models\Billing\User;
use Tests\Providers\Auth\AuthProvider;
use Tests\Providers\Billing\UserProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class AuthRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, AuthProvider, UserProvider, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * The User.
     *
     * @var User
     */
    protected $user;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->getDevUser();
    }

    /**
     * Test the return of the login route.
     *
     * @return void
     */
    public function test_login_route_returns_token()
    {
        $response = $this->loginByRoute($this->user);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'accessToken',
                'plainTextToken',
                'user'
            ]
        ]);
        $response->assertJsonPath('data.user.id', $this->user->id);
        $response->assertJsonPath('data.accessToken.tokenable_id', $this->user->id);
    }

    /**
     * Test if can show data from current token.
     *
     * @return void
     */
    public function test_show_data_from_current_token()
    {
        $loginResponse = $this->loginByRoute($this->user);

        $response = $this->getJson(route('token.show'), [
            'Authorization' => 'Bearer ' . $loginResponse->original->plainTextToken
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'accessToken',
                'plainTextToken',
                'user'
            ]
        ]);
        $response->assertJsonPath('data.user.id', $this->user->id);
        $response->assertJsonPath('data.accessToken.tokenable_id', $this->user->id);
    }

    /**
     * Test the return of the login with error route.
     *
     * @return void
     */
    public function test_login_route_credentials_error()
    {
        $response = $this->loginByRoute($this->user, 'WrongPassword');

        $response->assertStatus(400);
        $response->assertJsonStructure([
            'status',
            'message'
        ]);
        $response->assertJsonPath('message', __('auth.password'));
    }

    /**
     * Test the return of the cross auth login.
     * 
     * @dataProvider getUser
     *
     * @return void
     */
    public function test_cross_auth_route_returns_token(callable $provider)
    {
        [$user] = $provider();

        $this->loginByRoute($this->user);

        $response = $this->postJson('/api/login/cross', [
            'user_id' => $user->id,
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'accessToken',
                'plainTextToken',
                'user'
            ]
        ]);
        $response->assertJsonPath('data.user.id', $user->id);
        $response->assertJsonPath('data.accessToken.tokenable_id', $user->id);
    }

    /**
     * Test the return of a unauthorized call to cross auth login route.
     * 
     * @dataProvider getInvalidCrossAuthUsers
     * 
     * @return void
     */
    public function test_error_for_unauthorized_cross_auth_attempt(callable $provider)
    {
        [$user, $cross_user] = $provider();
        
        $this->loginByRoute($user);

        $response = $this->postJson('/api/login/cross', [
            'user_id' => $cross_user->id,
        ]);

        $response->assertStatus(403);
    }

    public function test_error_in_inactive_user_login()
    {
        $this->user->active = false;
        $this->user->save();
        $response = $this->loginByRoute($this->user);

        $response->assertStatus(403);
    }

    /**
     * Test the return of the logout route. 
     *
     * @return void
     */
    public function test_logout_route_return()
    {
        $this->loginByRoute($this->user);
        
        $response = $this->getJson('/api/logout');
        $response->assertNoContent();
    }
}
