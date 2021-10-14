<?php

namespace Tests\Unit\Models\Eloquent\Classroom\Test;

use App\Models\Eloquent\Classroom\Test\TestFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class TestFilterTest extends FilterTestCase
{
    /**
     * @var TestFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = TestFilters::class;

    public function test_category_filter()
    {
        $this->assertModelFilter('category');
    }
}
