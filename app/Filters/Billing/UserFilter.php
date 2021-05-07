<?php

namespace App\Filters\Billing;

use App\Filters\QueryFilter;

class UserFilter extends QueryFilter
{
    public function email($query, $value)
    {
        return $query->where('email', 'like', "%$value%");
    }

    public function name($query, $value)
    {
        return $query->where('name', 'like', "%$value%");
    }

    public function active($query)
    {
        return $query->active();
    }

    public function inactive($query)
    {
        return $query->inactive();
    }

    public function taxCode($query, $value)
    {
        return $query->where('tax_code', $value)->whereOr('tax_code_alt', $value);
    }

    public function phone($query, $value)
    {
        return $query->where('phone', $value)->whereOr('phone_alt', $value);
    }

    public function role($query, $value)
    {
        return $query->role($value);
    }
}