<?php

namespace Tests\Unit\Filters\Billing;

use App\Filters\Billing\CustomerFilter;
use Tests\Unit\Filters\FilterTestCase;

class CustomerFilterTest extends FilterTestCase
{
    /**
     * @var CustomerFilter
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = CustomerFilter::class;

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

    public function test_phone_filter()
    {
        $this->assertHasMethod($this->filter, 'phone');
    }

    public function test_status_filter()
    {
        $this->assertHasMethod($this->filter, 'status');
    }
}