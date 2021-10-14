<?php

namespace App\Models\Eloquent\Classroom\Module;

use App\Support\QueryFilter\QueryFilter;

class ModuleFilters extends QueryFilter
{
    public function course($query, $value)
    {
        return $query->whereHas('course', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }

    public function category($query, $value)
    {
        return $query->whereHas('category', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }
}