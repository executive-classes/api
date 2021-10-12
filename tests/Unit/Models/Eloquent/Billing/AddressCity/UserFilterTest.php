<?php

namespace Tests\Unit\Models\Eloquent\Billing\AddressCity;

use App\Models\Eloquent\Billing\User\UserFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class UserFilterTest extends FilterTestCase
{
    /**
     * @var UserFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = UserFilters::class;

    public function test_email_filter()
    {
        $this->assertModelFilter('email');
    }

    public function test_name_filter()
    {
        $this->assertModelFilter('name');
    }

    public function test_active_filter()
    {
        $this->assertModelFilter('active');
    }

    public function test_inactive_filter()
    {
        $this->assertModelFilter('inactive');
    }

    public function test_taxCode_filter()
    {
        $this->assertModelFilter('taxCode');
    }

    public function test_phone_filter()
    {
        $this->assertModelFilter('phone');
    }

    public function test_role_filter()
    {
        $this->assertModelFilter('role');
    }
}