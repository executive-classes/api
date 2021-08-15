<?php

namespace App\Filters\Classroom;

use App\Filters\QueryFilter;

class CourseFilter extends QueryFilter
{
    public function category($query, $value)
    {
        return $query->whereHas('category', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }
}