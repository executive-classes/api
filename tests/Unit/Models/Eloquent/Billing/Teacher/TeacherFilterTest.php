<?php

namespace Tests\Unit\Models\Eloquent\Billing\Teacher;

use App\Models\Eloquent\Billing\Teacher\TeacherFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class TeacherFilterTest extends FilterTestCase
{
    /**
     * @var TeacherFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = TeacherFilters::class;

    public function test_email_filter()
    {
        $this->assertModelFilter('email');
    }

    public function test_name_filter()
    {
        $this->assertModelFilter('name');
    }

    public function test_taxCode_filter()
    {
        $this->assertModelFilter('taxCode');
    }

    public function test_status_filter()
    {
        $this->assertModelFilter('status');
    }
}