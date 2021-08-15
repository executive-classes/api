<?php

namespace App\Filters\General;

use App\Filters\QueryFilter;

class CategoryFilter extends QueryFilter
{
    public function type($query, $value)
    {
        return $query->where('type', "$value");
    }
}