<?php

namespace App\Support\QueryFilter;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Filter a result set.
     *
     * @param  Builder      $query
     * @param  QueryFilter $filters
     * @return Builder
     */
    public function scopeFilter($query, QueryFilter $filter)
    {
        return $filter->apply($query);
    }
}