<?php

namespace App\Filters\Billing;

use App\Filters\QueryFilter;

class StudentFilter extends QueryFilter
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
        return $query->where('student_status_id', $value);
    }
}