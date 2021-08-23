<?php

namespace App\Models\Eloquent\Billing\Address;

use App\Support\QueryFilter\QueryFilter;

class AddressFilters extends QueryFilter
{
    public function zip($query, $value)
    {
        return $query->where('zip', 'like', "%$value%");
    }

    public function street($query, $value)
    {
        return $query->where('street', 'like', "%$value%");
    }

    public function number($query, $value)
    {
        return $query->where('number', 'like', "%$value%");
    }

    public function complement($query, $value)
    {
        return $query->where('complement', 'like', "%$value%");
    }

    public function district($query, $value)
    {
        return $query->where('district', 'like', "%$value%");
    }

    public function city($query, $value)
    {
        return $query->where('city', 'like', "%$value%");
    }

    public function state($query, $value)
    {
        return $query->where('state', 'like', "%$value%");
    }

    public function country($query, $value)
    {
        return $query->where('country', 'like', "%$value%");
    }
}