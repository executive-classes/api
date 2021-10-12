<?php

namespace Tests\Unit\Models\Eloquent\Billing\Student;

use App\Models\Eloquent\Billing\Student\StudentFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class StudentFilterTest extends FilterTestCase
{
    /**
     * @var StudentFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = StudentFilters::class;

    public function test_customerId_filter()
    {
        $this->assertModelFilter('customerId');
    }

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