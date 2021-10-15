<?php

namespace App\Models\Eloquent\Classroom\Material;

use App\Support\QueryFilter\QueryFilter;

class MaterialFilters extends QueryFilter
{
    public function category($query, $value)
    {
        return $query->whereHas('category', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }
}