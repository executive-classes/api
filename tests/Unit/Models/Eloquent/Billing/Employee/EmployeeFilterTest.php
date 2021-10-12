<?php

namespace Tests\Unit\Models\Eloquent\Billing\Employee;

use App\Models\Eloquent\Billing\Employee\EmployeeFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

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

    public function test_position_filter()
    {
        $this->assertModelFilter('position');
    }
}