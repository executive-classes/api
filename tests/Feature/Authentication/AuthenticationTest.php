<?php

namespace Tests\Feature\Authentication;

use App\Models\Billing\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Mockery\MockInterface;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected $spy;
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        
        $this->user = User::first();
    }

    public function test_user_can_authenticate()
    {
        $token = $this->user->login();

        $this->assertAuthenticatedAs($this->user);
        $this->assertInstanceOf(PersonalAccessToken::class, $this->user->currentAccessToken());
        $this->assertCount(1, $this->user->tokens);

        $this->assertInstanceOf(NewAccessToken::class, $token);
        $this->assertInstanceOf(PersonalAccessToken::class, $token->accessToken);
        $this->assertIsString($token->plainTextToken);
    }

    public function test_user_can_logout()
    {
        $this->user->login();
        $this->user->logout();

        $this->user->currentAccessToken()->shouldHaveReceived('delete');
    }
}
