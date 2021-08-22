<?php

namespace Tests\Unit\Filters\General;

use App\Models\General\Category\CategoryFilters;
use Tests\Unit\Filters\FilterTestCase;

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
        $this->assertHasMethod($this->filter, 'type');
    }
}