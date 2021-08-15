<?php

namespace Tests\Unit\Filters\Classroom;

use App\Filters\Classroom\CourseFilter;
use Tests\TestCase;

class CourseFilterTest extends TestCase
{
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->filter = new CourseFilter();
    }

    public function test_category_filter()
    {
        $this->assertHasMethod($this->filter, 'category');
    }
}
