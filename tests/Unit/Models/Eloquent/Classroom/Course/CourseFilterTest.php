<?php

namespace Tests\Unit\Models\Eloquent\Classroom\Course;

use App\Models\Eloquent\Classroom\Course\CourseFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

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
        $this->assertModelFilter('category');
    }
}
