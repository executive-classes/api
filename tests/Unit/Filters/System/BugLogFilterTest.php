<?php

namespace Tests\Unit\Filters\System;

use App\Models\Eloquent\System\SystemBugLog\SystemBugLogFilters;
use Tests\Unit\Filters\FilterTestCase;

class BugLogFilterTest extends FilterTestCase
{
    /**
     * @var SystemBugLogFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = SystemBugLogFilters::class;

    public function test_date_filter()
    {
        $this->assertHasMethod($this->filter, 'date');
    }

    public function test_user_filter()
    {
        $this->assertHasMethod($this->filter, 'user');
    }

    public function test_app_filter()
    {
        $this->assertHasMethod($this->filter, 'app');
    }

    public function test_ajax_filter()
    {
        $this->assertHasMethod($this->filter, 'ajax');
    }
}