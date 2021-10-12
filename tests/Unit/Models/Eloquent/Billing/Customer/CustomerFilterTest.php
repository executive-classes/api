<?php

namespace Tests\Unit\Models\Eloquent\Billing\Customer;

use App\Models\Eloquent\Billing\Customer\CustomerFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class CustomerFilterTest extends FilterTestCase
{
    /**
     * @var CustomerFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = CustomerFilters::class;

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

    public function test_phone_filter()
    {
        $this->assertModelFilter('phone');
    }

    public function test_status_filter()
    {
        $this->assertModelFilter('status');
    }
}