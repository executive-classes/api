<?php

namespace App\Support\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    /**
     * The filters.
     * 
     * @var array
     */
    protected $filters;

    /**
     * Create a new QueryFilters instance.
     *
     * @param array $filters
     */
    public function __construct(array $filters = null)
    {
        $this->filters = $filters ?? request()->all();
    }

    /**
     * Apply the filters to the builder.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function apply(Builder $query)
    {
        foreach ($this->filters as $name => $value) {
            $name = Str::camel($name);

            if (!method_exists($this, $name)) {
                continue;
            }

            $query = $this->$name($query, $value);
        }

        return $query;
    }

    /**
     * Set filters.
     *
     * @param array $filters
     * @return array
     */
    public function setFilters(array $filters): array
    {
        return $this->filters = $filters;
    }

    /**
     * Merge the filters with other provided filters.
     *
     * @param array $filters
     * @return array
     */
    public function mergeFilters(array $filters): array
    {
        return array_merge($this->filters, $filters);
    }
}
