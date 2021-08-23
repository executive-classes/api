<?php

namespace Tests\Unit\Filters\Billing;

use App\Models\Eloquent\Billing\Employee\EmployeeFilters;
use Tests\Unit\Filters\FilterTestCase;

class EmployeeFilterTest extends FilterTestCase
{
    /**
     * @var EmployeeFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = EmployeeFilters::class;

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