<?php

namespace Tests\Unit\Filters\Billing;

use App\Filters\Billing\TeacherFilter;
use Tests\Unit\Filters\FilterTestCase;

class TeacherFilterTest extends FilterTestCase
{
    /**
     * @var TeacherFilter
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = TeacherFilter::class;

    public function test_email_filter()
    {
        $this->assertHasMethod($this->filter, 'email');
    }

    public function test_name_filter()
    {
        $this->assertHasMethod($this->filter, 'name');
    }

    public function test_taxCode_filter()
    {
        $this->assertHasMethod($this->filter, 'taxCode');
    }

    public function test_status_filter()
    {
        $this->assertHasMethod($this->filter, 'status');
    }
}