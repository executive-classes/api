<?php

namespace App\Models\Billing\Employee;

use App\Models\Billing\User\User;
use App\Models\Billing\EmployeeStatus\EmployeeStatus;
use App\Models\Billing\EmployeePosition\EmployeePosition;

trait EmployeeRelations
{
    /**
     * User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(EmployeeStatus::class, 'employee_status_id');
    }

    /**
     * Position relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(EmployeePosition::class, 'employee_position_id');
    }
}