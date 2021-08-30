<?php

namespace App\Models\Eloquent\Billing\Teacher;

trait TeacherScopes
{
    /**
     * Teacher Email Scope.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeEmail($query, $value)
    {
        return $query->whereHas('user', function ($q) use ($value) {
            return $q->where('email', $value);
        });
    }
}