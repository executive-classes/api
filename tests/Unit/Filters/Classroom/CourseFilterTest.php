<?php

namespace Tests\Unit\Filters\Classroom;

use App\Filters\Classroom\CourseFilter;
use Tests\Unit\Filters\FilterTestCase;

class CourseFilterTest extends FilterTestCase
{
    /**
     * @var CourseFilter
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = CourseFilter::class;

    public function test_category_filter()
    {
        $this->assertHasMethod($this->filter, 'category');
    }
}
