<?php

namespace App\Traits\Models\Billing;

use App\Models\Billing\UserRole;

trait UserScopes
{
    public function scopeAdmin($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('id', UserRole::ADMIN);
        });
    }
}