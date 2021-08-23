<?php

namespace Tests\Unit\Filters\Billing;

use App\Models\Eloquent\Billing\Biller\BillerFilters;
use Tests\Unit\Filters\FilterTestCase;

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

    public function test_phone_filter()
    {
        $this->assertHasMethod($this->filter, 'phone');
    }

    public function test_status_filter()
    {
        $this->assertHasMethod($this->filter, 'status');
    }

    public function test_interval_filter()
    {
        $this->assertHasMethod($this->filter, 'interval');
    }

    public function test_paymentMethod_filter()
    {
        $this->assertHasMethod($this->filter, 'paymentMethod');
    }
}