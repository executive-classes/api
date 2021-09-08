<?php

namespace Tests\Providers\Auth;

use Tests\FactoryMaker;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Eloquent\Billing\User\User;
use Illuminate\Foundation\Testing\WithFaker;

trait AccessTokenProvider
{
    use FactoryMaker;
    use WithFaker;

    private function makeOneAccessToken(): PersonalAccessToken
    {
        return new PersonalAccessToken([
            'name' => $this->faker()->name,
            'abilities' => $this->faker()->shuffleArray,
            'tokenable_id' => $this->faker()->numberBetween(1, 10000),
            'tokenable_type' => $this->faker()->filePath(),
            'updated_at' => $this->faker()->dateTime(),
            'created_at' => $this->faker()->dateTime(),
            'expires_at' => $this->faker()->dateTime(),
            'tokenable' => $this->makeOne(User::class)
        ]);
    }
}