<?php

namespace Tests;

use App\Models\Eloquent\Billing\Employee\Employee;
use App\Models\Eloquent\Billing\User\User;

trait CreatesUser
{
    public function getDevUser()
    {
        return User::dev()->first();
    }

    public function newDevUser()
    {
        return User::factory()
            ->has(Employee::factory()->developer(), 'employee')
            ->state(config('test.user.type.dev'))
            ->make();
    }
}