<?php

namespace Tests\Unit\Filters\Billing;

use App\Filters\Billing\StudentFilter;
use Tests\Unit\Filters\FilterTestCase;

class StudentFilterTest extends FilterTestCase
{
    /**
     * @var StudentFilter
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = StudentFilter::class;

    public function test_customerId_filter()
    {
        $this->assertHasMethod($this->filter, 'customerId');
    }

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