<?php

namespace Tests\Unit\Models\Eloquent\General\Category;

use App\Models\Eloquent\General\Category\CategoryFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class CategoryFilterTest extends FilterTestCase
{
    /**
     * @var CategoryFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = CategoryFilters::class;

    public function test_type_filter()
    {
        $this->assertModelFilter('type');
    }
}