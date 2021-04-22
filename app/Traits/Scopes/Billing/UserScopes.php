<?php

namespace App\Traits\Scopes\Billing;

use App\Enums\Billing\EmployeePositionEnum;

trait UserScopes
{
    public function scopeAdmin($query)
    {
        return $query->whereHas('employee', function ($q) {
            $q->where('employee_position_id', EmployeePositionEnum::ADMINISTRATOR);
        });
    }

    public function scopeDev($query)
    {
        return $query->whereHas('employee', function ($q) {
            $q->where('employee_position_id', EmployeePositionEnum::DEVELOPER);
        });
    }
}