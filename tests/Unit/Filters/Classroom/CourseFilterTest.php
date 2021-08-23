<?php

namespace Tests\Unit\Filters\Classroom;

use App\Models\Eloquent\Classroom\Course\CourseFilters;
use Tests\Unit\Filters\FilterTestCase;

class CourseFilterTest extends FilterTestCase
{
    /**
     * @var CourseFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = CourseFilters::class;

    public function test_category_filter()
    {
        $this->assertHasMethod($this->filter, 'category');
    }
}
