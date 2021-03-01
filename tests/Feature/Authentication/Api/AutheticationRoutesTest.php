<?php

namespace Tests\Feature\Authentication\Api;

use App\Models\Billing\TaxType;
use App\Models\Billing\User;
use App\Traits\Tests\Authentication\AuthenticationMaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutheticationRoutesTest extends TestCase
{
    use RefreshDatabase, AuthenticationMaker;

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
        $this->seed();
        
        $this->user = User::dev()->first();
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
                'plainTextToken'
            ]
        ]);
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
     * @return void
     */
    public function test_cross_auth_route_returns_token()
    {
        $this->loginByRoute($this->user);

        $user = User::where('id', '<>', $this->user->id)->first();

        $response = $this->postJson('/api/login/cross', [
            'user_id' => $user->id,
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'accessToken',
                'plainTextToken'
            ]
        ]);
        $response->assertJsonPath('data.accessToken.tokenable_id', $user->id);
    }

    /**
     * Test the return of a unauthorized call to cross auth login route.
     *
     * @return void
     */
    public function test_error_for_unauthorized_cross_auth_attempt()
    {
        $user = User::factory()
            ->for(TaxType::find('cpf'), 'taxType')
            ->create();
        
        $this->loginByRoute($user);

        $cross_user = User::where('id', '<>', $this->user->id)->first();

        $response = $this->postJson('/api/login/cross', [
            'user_id' => $cross_user->id,
        ]);

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
