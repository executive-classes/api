<?php

namespace Tests\Unit\Models\Eloquent\Classroom\Material;

use App\Models\Eloquent\Classroom\Material\MaterialFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class MaterialFilterTest extends FilterTestCase
{
    /**
     * @var MaterialFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = MaterialFilters::class;

    public function test_category_filter()
    {
        $this->assertModelFilter('category');
    }
}
