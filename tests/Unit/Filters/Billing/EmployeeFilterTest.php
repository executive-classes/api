<?php

namespace Tests\Unit\Filters\Billing;

use App\Filters\Billing\EmployeeFilter;
use Tests\Unit\Filters\FilterTestCase;

class EmployeeFilterTest extends FilterTestCase
{
    /**
     * @var EmployeeFilter
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = EmployeeFilter::class;

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

    public function test_position_filter()
    {
        $this->assertHasMethod($this->filter, 'position');
    }
}