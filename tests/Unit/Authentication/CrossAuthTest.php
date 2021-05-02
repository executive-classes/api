<?php

namespace Tests\Unit\Authentication;

use App\Models\Billing\User;
use Tests\Providers\Billing\UserProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\PersonalAccessToken;
use Tests\TestCase;
use Tests\UseUsers;

class CrossAuthTest extends TestCase
{
    use RefreshDatabase, UserProvider, UseUsers;

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
     * Test if a user can cross auth.
     *
     * @return void
     */
    public function test_user_can_cross_auth()
    {
        $cross_user = User::factory()->create();

        $token = $cross_user->crossLogin($this->user);

        $this->assertAuthenticatedAs($cross_user);
        $this->assertInstanceOf(PersonalAccessToken::class, $cross_user->currentAccessToken());
        $this->assertEquals($cross_user->id, $token->accessToken->tokenable_id);
        $this->assertStringContainsString($this->user->email, $token->accessToken->name);
    }

    /**
     * Test if can get the cross user by user token.
     *
     * @return void
     */
    public function test_can_get_cross_user()
    {
        $cross_user = User::factory()->create();

        $token = $cross_user->crossLogin($this->user);

        $this->assertAuthenticatedAs($cross_user);
        $this->assertInstanceOf(PersonalAccessToken::class, $cross_user->currentAccessToken());

        $cross_user->withAccessToken($token->accessToken);

        $this->assertEquals($this->user->email, $cross_user->crossEmail());
        $this->assertEquals($this->user, $cross_user->crossUser());
        $this->assertEquals($this->user->id, $cross_user->crossId());
    }
}
