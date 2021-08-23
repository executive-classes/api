<?php

namespace App\Models\Eloquent\Billing\EmployeePosition;

use App\Models\Eloquent\Billing\UserPrivilege\UserPrivilege;
use App\Models\Eloquent\Billing\Employee\Employee;
use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;

trait EmployeePositionRelations
{
    /**
     * Privileges relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function privileges()
    {
        return $this->belongsToMany(UserPrivilege::class, 'privilege_x_position', 'position_id', 'privilege_id');
    }

    /**
     * Employees relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'employee_position_id');
    }

    /**
     * Parent relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(EmployeePosition::class, 'parent_id', 'id');
    }

    /**
     * Children relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function children()
    {
        return $this->hasMany(EmployeePosition::class, 'parent_id', 'id');
    }
}