<?php

namespace Tests\Unit\Models\Eloquent\Classroom\Lesson;

use App\Models\Eloquent\Classroom\Lesson\LessonFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class LessonFilterTest extends FilterTestCase
{
    /**
     * @var LessonFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = LessonFilters::class;

    public function test_course_filter()
    {
        $this->assertModelFilter('course');
    }

    public function test_module_filter()
    {
        $this->assertModelFilter('module');
    }

    public function test_category_filter()
    {
        $this->assertModelFilter('category');
    }
}
