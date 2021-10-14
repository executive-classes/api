<?php

namespace App\Models\Eloquent\Classroom\Test;

use App\Support\QueryFilter\QueryFilter;

class TestFilters extends QueryFilter
{
    public function category($query, $value)
    {
        return $query->whereHas('category', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }
}