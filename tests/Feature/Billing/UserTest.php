<?php

namespace Tests\Feature\Billing;

use App\Models\Eloquent\Billing\User\User;
use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class UserTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('user.index'));
        $this->assertAuthenticationRequired(route('user.store'), 'POST');
        $this->assertAuthenticationRequired(route('user.show', ['user' => 1]));
        $this->assertAuthenticationRequired(route('user.update', ['user' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('user.cancel', ['user' => 1]), 'DELETE');
    }

    public function test_user_index()
    {
        // Data creation
        $this->createMany(User::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('user.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_user_store()
    {
        // Data creation
        $user = $this->makeOne(User::class, true);
        $data = collect($user->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('user.store'), $user->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('user', $data->only(['email', 'tax_code'])->toArray());
    }

    public function test_user_show()
    {
        // Data creation
        $user = $this->createOne(User::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('user.show', ['user' => $user->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_user_update()
    {
        // Data creation
        $user = $this->createOne(User::class, true);
        $newUser = $this->makeOne(User::class, true);
        $data = collect($newUser->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(route('user.update', ['user' => $user->id]), $newUser->toArray());

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('user', $data->only(['email', 'tax_code'])->toArray());
    }

    public function test_user_cancel()
    {
        // Data creation
        $user = $this->createOne(User::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('user.cancel', ['user' => $user->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('user', [
            'id' => $user->id,
            'active' => false
        ]);
    }
}