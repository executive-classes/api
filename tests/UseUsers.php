<?php

namespace Tests;

use App\Models\Billing\User;

trait UseUsers
{
    public function getDevUser()
    {
        return User::dev()->first();
    }
}