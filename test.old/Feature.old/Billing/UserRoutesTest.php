<?php

namespace Tests\Feature\Billing;

use App\Models\Eloquent\Billing\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class UserRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->getDevUser()->login();
        User::factory()->count(3)->create();
    }

    public function test_can_list_users()
    {
        $response = $this->getJson(route('user.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(User::count(), 'data');
    }

    public function test_can_filter_user_list()
    {
        $email = User::first()->email;
        $response = $this->getJson(route('user.index', ['email' => $email]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(User::where('email', $email)->count(), 'data');
    }

    public function test_can_get_user()
    {
        $id = User::first()->id;
        $response = $this->getJson(route('user.show', ['user' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
    }

    public function test_can_create_user()
    {
        $data = User::factory()->make()->toArray();
        $data['password'] = 'SenhaForte123@';
        $response = $this->postJson(route('user.store'), $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.email', $data['email']);
    }

    public function test_can_update_user()
    {
        $data = User::factory()->make()->toArray();
        $id = User::first()->id;
        $response = $this->putJson(route('user.update', ['user' => $id]), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.email', $data['email']);
    }

    public function test_can_cancel_user()
    {
        $id = User::first()->id;
        $response = $this->deleteJson(route('user.update', ['user' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.active', false);
    }
}
