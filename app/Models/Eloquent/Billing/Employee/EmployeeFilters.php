<?php

namespace App\Models\Eloquent\Billing\Employee;

use App\Support\QueryFilter\QueryFilter;

class EmployeeFilters extends QueryFilter
{
    public function email($query, $value)
    {
        return $query->whereHas('user', function ($q) use ($value) {
            $q->where('email', 'like', "%$value%");
        });
    }

    public function name($query, $value)
    {
        return $query->whereHas('user', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }

    public function taxCode($query, $value)
    {
        return $query->whereHas('user', function ($q) use ($value) {
            $q->where('tax_code', $value)->whereOr('tax_code_alt', $value);
        });
    }

    public function status($query, $value)
    {
        return $query->where('employee_status_id', $value);
    }

    public function position($query, $value)
    {
        return $query->where('employee_position_id', $value);
    }
}