<?php

namespace Tests\Providers\Auth;

use App\Models\Eloquent\Billing\User\User;

trait AuthProvider
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