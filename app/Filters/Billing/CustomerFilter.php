<?php

namespace App\Filters\Billing;

use App\Filters\QueryFilter;

class CustomerFilter extends QueryFilter
{
    public function email($query, $value)
    {
        return $query->where('email', 'like', "%$value%");
    }

    public function name($query, $value)
    {
        return $query->where('name', 'like', "%$value%");
    }

    public function taxCode($query, $value)
    {
        return $query->where('tax_code', $value)->whereOr('tax_code_alt', $value);
    }

    public function phone($query, $value)
    {
        return $query->where('phone', $value)->whereOr('phone_alt', $value);
    }

    public function status($query, $value)
    {
        return $query->where('customer_status_id', $value);
    }
}