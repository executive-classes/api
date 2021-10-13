<?php

namespace App\Traits\Models\Authentication;

use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\HasApiTokens as DefaultHasApiTokens;

trait HasApiTokens
{
    use DefaultHasApiTokens;

    /**
     * Get the access tokens that belong to model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function token()
    {
        return $this->morphOne(Sanctum::$personalAccessTokenModel, 'tokenable')->orderBy('id', 'desc')->limit(1);
    }

    /**
     * Get the access token currently associated with the user.
     *
     * @return \Laravel\Sanctum\Contracts\HasAbilities
     */
    public function currentAccessToken()
    {
        return is_object($this->accessToken) && get_class($this->accessToken) == PersonalAccessToken::class
            ? $this->accessToken
            : $this->token;
    }
}