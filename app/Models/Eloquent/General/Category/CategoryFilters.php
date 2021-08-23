<?php

namespace App\Models\Eloquent\General\Category;

use App\Support\QueryFilter\QueryFilter;

class CategoryFilters extends QueryFilter
{
    public function type($query, $value)
    {
        return $query->where('type', "$value");
    }
}