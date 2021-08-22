<?php

namespace App\Models\Billing\User;

use Illuminate\Database\Query\Builder;
use App\Enums\Billing\EmployeePositionEnum;

trait UserScopes
{
    /**
     * User Status scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * User Inactive Status scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    /**
     * User Role Scope
     *
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeRole($query, $value)
    {
        switch ($value) {
            case 'student':
                return $query->whereHas('student');
                break;

            case 'teacher':
                return $query->whereHas('teacher');
                break;

            default:
                return $query->whereHas('employee', function ($q) use ($value) {
                    $q->where('employee_position_id', $value);
                });
                break;
        }
    }

    /**
     * Administrator User scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdmin($query)
    {
        return $query->whereHas('employee', function ($q) {
            $q->where('employee_position_id', EmployeePositionEnum::ADMINISTRATOR);
        });
    }

    /**
     * Developer User scope.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDev($query)
    {
        return $query->whereHas('employee', function ($q) {
            $q->where('employee_position_id', EmployeePositionEnum::DEVELOPER);
        });
    }
}