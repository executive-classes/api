<?php

namespace Tests\Providers\Authentication;

use App\Models\Billing\User;

trait AuthenticationProvider
{
    public function loginByRoute(User $user, string $password = null, string $language = 'en')
    {
        if (!$password) {
            $password = config('test.user.password');
        }
        
        return $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
            'language' => $language
        ]);
    }
}