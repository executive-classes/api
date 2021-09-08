<?php

namespace Tests\Providers\Auth;

use Laravel\Sanctum\NewAccessToken;
use Illuminate\Foundation\Testing\WithFaker;

trait TokenProvider
{
    use AccessTokenProvider;
    use WithFaker;

    public function makeOneNewAccessToken()
    {
        return new NewAccessToken($this->makeOneAccessToken(), $this->faker()->text(64));
    }
}