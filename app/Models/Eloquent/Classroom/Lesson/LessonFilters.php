<?php

namespace App\Models\Eloquent\Classroom\Lesson;

use App\Support\QueryFilter\QueryFilter;

class LessonFilters extends QueryFilter
{
    public function course($query, $value)
    {
        return $query->whereHas('course', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }
    
    public function module($query, $value)
    {
        return $query->whereHas('module', function ($q) use ($value) {
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