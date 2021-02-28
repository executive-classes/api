<?php

namespace App\Traits\Tests\Authentication;

use App\Models\Billing\User;
use Database\Factories\Billing\UserFactory;

trait AuthenticationMaker
{
    public function loginByRoute(User $user, string $password = UserFactory::PASSWORD, string $language = 'en')
    {
        return $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
            'language' => $language
        ]);
    }
}