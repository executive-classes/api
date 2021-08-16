<?php

namespace Tests\Unit\Filters\General;

use App\Filters\General\CategoryFilter;
use Tests\Unit\Filters\FilterTestCase;

class CategoryFilterTest extends FilterTestCase
{
    /**
     * @var CategoryFilter
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = CategoryFilter::class;

    public function test_type_filter()
    {
        $this->assertHasMethod($this->filter, 'type');
    }
}