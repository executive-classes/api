<?php

namespace Tests\Feature\Authentication;

use App\Models\Billing\TaxType;
use App\Models\Billing\User;
use App\Models\Billing\UserRole;
use Database\Factories\Billing\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutheticationRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        
        $this->user = User::first();
    }

    public function test_login_route_returns_token()
    {
        $response = $this->login($this->user);

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

    public function test_login_route_credentials_error()
    {
        $response = $this->login($this->user, 'WrongPassword');


        $response->assertStatus(400);
        $response->assertJsonStructure([
            'status',
            'message'
        ]);
        $response->assertJsonPath('message', __('auth.password'));
    }

    public function test_cross_auth_route_returns_token()
    {
        $this->login($this->user);

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

    public function test_error_for_unauthorized_cross_auth_attempt()
    {
        $user = User::factory()
            ->for(TaxType::find('cpf'), 'taxType')
            ->hasAttached(UserRole::find('fin'), [], 'roles')
            ->create();
        
        $this->login($user);

        $cross_user = User::where('id', '<>', $this->user->id)->first();

        $response = $this->postJson('/api/login/cross', [
            'user_id' => $cross_user->id,
        ]);

        $response->assertStatus(403);
    }

    public function test_logout_route_return()
    {
        $this->login($this->user);
        
        $response = $this->getJson('/api/logout');
        $response->assertNoContent();
    }

    public function test_user_can_change_language()
    {
        $this->login($this->user, UserFactory::PASSWORD, 'pt_BR');

        $this->assertEquals('pt_BR', app()->getLocale());
    }

    protected function login(User $user, string $password = UserFactory::PASSWORD, string $language = 'en')
    {
        return $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
            'language' => $language
        ]);
    }

}
