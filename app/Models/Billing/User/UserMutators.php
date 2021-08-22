<?php

namespace App\Models\Billing\User;

use Illuminate\Support\Facades\Hash;

trait UserMutators
{
    /**
     * Password attribute mutator.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
