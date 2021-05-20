<?php

namespace Tests\Unit\Auth;

use App\Models\Billing\User;
use Tests\Providers\Billing\UserProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, UserProvider;

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
        
        $this->user = User::factory()->create();
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
     * @dataProvider getUserWithMultipleLanguages
     * 
     * @return void
     */
    public function test_user_can_change_language(callable $provider)
    {
        [$user] = $provider();

        $user->login();

        $this->assertEquals($user->language->id, app()->getLocale());
    }
}
