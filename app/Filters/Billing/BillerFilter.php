<?php

namespace App\Filters\Billing;

use App\Filters\QueryFilter;

class BillerFilter extends QueryFilter
{
    public function customerId($query, $value)
    {
        return $query->where('customer_id', $value);
    }

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
        return $query->where('biller_status_id', $value);
    }

    public function interval($query, $value)
    {
        return $query->where('payment_interval_id', $value);
    }

    public function paymentMethod($query, $value)
    {
        return $query->where('payment_method_id', $value);
    }
}