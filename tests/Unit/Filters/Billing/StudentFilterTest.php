<?php

namespace Tests\Unit\Filters\Billing;

use App\Models\Eloquent\Billing\Student\StudentFilters;
use Tests\Unit\Filters\FilterTestCase;

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