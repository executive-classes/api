<?php

namespace Tests\Feature\Billing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Models\Eloquent\Billing\User\User;

class ProfileTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('profile.index'));
        $this->assertAuthenticationRequired(route('profile.update'), 'PUT');
    }

    public function test_profile_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('profile.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_profile_update()
    {
        // Data creation
        $newUser = $this->makeOne(User::class, true);
        $data = collect($newUser->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('profile.update'), 
                $newUser->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('user', $data->only(['email', 'tax_code'])->toArray());
    }
}