<?php

namespace App\Traits\Models\Billing;

use App\Models\Billing\EmployeePosition;
use App\Models\Billing\UserPrivilege;

trait UserScopes
{
    public function scopeAdmin($query)
    {
        return $query->whereHas('employee', function ($q) {
            $q->where('employee_position_id', EmployeePosition::ADMINISTRATOR);
        });
    }

    public function scopeDev($query)
    {
        return $query->whereHas('employee', function ($q) {
            $q->where('employee_position_id', EmployeePosition::DEVELOPER);
        });
    }
}