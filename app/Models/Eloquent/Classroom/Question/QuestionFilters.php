<?php

namespace App\Models\Eloquent\Classroom\Question;

use App\Support\QueryFilter\QueryFilter;

class QuestionFilters extends QueryFilter
{
    public function category($query, $value)
    {
        return $query->whereHas('category', function ($q) use ($value) {
            $q->where('name', 'like', "%$value%");
        });
    }
}