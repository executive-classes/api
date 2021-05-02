<?php

namespace Tests;

use App\Models\Billing\User;

trait UseUsers
{
    public function getDevUser()
    {
        return User::where('email', config('test.user.emails.dev'))->first();
    }
}