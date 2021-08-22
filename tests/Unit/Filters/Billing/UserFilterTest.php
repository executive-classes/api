<?php

namespace Tests\Unit\Filters\Billing;

use App\Models\Billing\User\UserFilters;
use Tests\Unit\Filters\FilterTestCase;

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
        $this->assertHasMethod($this->filter, 'email');
    }

    public function test_name_filter()
    {
        $this->assertHasMethod($this->filter, 'name');
    }

    public function test_active_filter()
    {
        $this->assertHasMethod($this->filter, 'active');
    }

    public function test_inactive_filter()
    {
        $this->assertHasMethod($this->filter, 'inactive');
    }

    public function test_taxCode_filter()
    {
        $this->assertHasMethod($this->filter, 'taxCode');
    }

    public function test_phone_filter()
    {
        $this->assertHasMethod($this->filter, 'phone');
    }

    public function test_role_filter()
    {
        $this->assertHasMethod($this->filter, 'role');
    }
}