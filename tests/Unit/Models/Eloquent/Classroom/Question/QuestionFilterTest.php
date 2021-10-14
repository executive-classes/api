<?php

namespace Tests\Unit\Models\Eloquent\Classroom\Question;

use App\Models\Eloquent\Classroom\Question\QuestionFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class QuestionFilterTest extends FilterTestCase
{
    /**
     * @var QuestionFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = QuestionFilters::class;

    public function test_category_filter()
    {
        $this->assertModelFilter('category');
    }
}
