<?php

namespace App\Models\Classroom\Course;

use App\Support\QueryFilter\QueryFilter;

class CourseFilters extends QueryFilter
{
    public function category($query, $value)
    {
        return $query->whereHas('category', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }
}