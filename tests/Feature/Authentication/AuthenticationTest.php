<?php

namespace Tests\Feature\Authentication;

use App\Models\Billing\SystemLanguage;
use App\Models\Billing\User;
use Database\Factories\Billing\UserFactory;
use Database\Seeders\Billing\SystemLanguageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Mockery\MockInterface;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

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
        
        $this->user = User::first();
    }

    /**
     * Test if a user can authenticate.
     *
     * @return void
     */
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

    /**
     * Test if a user can logout.
     *
     * @return void
     */
    public function test_user_can_logout()
    {
        $this->user->login();
        $this->user->logout();

        $this->user->currentAccessToken()->shouldHaveReceived('delete');
    }
    
    /**
     * Test the application language change after login.
     *
     * @return void
     */
    public function test_user_can_change_language()
    {
        $this->user->setLanguage(SystemLanguage::PT_BR);
        $this->user->login();

        $this->assertEquals(SystemLanguage::PT_BR, app()->getLocale());
    }
}
