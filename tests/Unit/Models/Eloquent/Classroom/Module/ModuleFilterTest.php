<?php

namespace Tests\Unit\Models\Eloquent\Classroom\Module;

use Tests\Unit\Models\Eloquent\FilterTestCase;
use App\Models\Eloquent\Classroom\Module\ModuleFilters;

class ModuleFilterTest extends FilterTestCase
{
    /**
     * @var ModuleFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = ModuleFilters::class;

    public function test_course_filter()
    {
        $this->assertModelFilter('course');
    }

    public function test_category_filter()
    {
        $this->assertModelFilter('category');
    }
}
