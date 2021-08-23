<?php

namespace App\Traits\Models\Authentication;

use App\Models\Eloquent\Billing\User\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

trait CanAuthenticate
{
    /**
     * Log in the user.
     *
     * @param string $request_email
     * @param string $request_agent
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function login(string $request_email = null, string $request_agent = null): \Laravel\Sanctum\NewAccessToken
    {
        if (empty($request_email)) {
            $request_email = $this->email;
        }

        if (empty($request_agent)) {
            $request_agent = env('APP_NAME');
        }

        $token_name = $request_email . "|" . $request_agent;

        // Remove the tokens of the same source
        $this->tokens()->where('name', $token_name)->delete();

        // Get a array of the user's privileges
        $privileges = $this->getAllPrivileges()->map(function ($privilege) {
            return $privilege->id;
        })->toArray();

        // Create the token
        $token = $this->createToken($token_name, $privileges);
        Sanctum::actingAs($this, $token->accessToken->abilities);

        $this->changeLanguage();

        return $token;
    }

    /**
     * Cross auth the user.
     *
     * @param User $user
     * @param string $request_agent
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function crossLogin(User $user, string $request_agent = null): \Laravel\Sanctum\NewAccessToken
    {
        return $this->login($user->email, $request_agent);
    }

    /**
     * Log out the user.
     *
     * @return void
     */
    public function logout()
    {
        $this->currentAccessToken()->delete();
    }

    /**
     * Check the password
     *
     * @param string $password
     * @return bool
     */
    public function check(string $password): bool
    {
        return Hash::check($password, $this->password);
    }
}