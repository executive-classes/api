<?php

namespace Tests\Unit\Models\Eloquent\Billing\Biller;

use App\Models\Eloquent\Billing\Biller\BillerFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class BillerFilterTest extends FilterTestCase
{
    /**
     * @var BillerFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = BillerFilters::class;

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

    public function test_phone_filter()
    {
        $this->assertModelFilter('phone');
    }

    public function test_status_filter()
    {
        $this->assertModelFilter('status');
    }

    public function test_interval_filter()
    {
        $this->assertModelFilter('interval');
    }

    public function test_paymentMethod_filter()
    {
        $this->assertModelFilter('paymentMethod');
    }
}