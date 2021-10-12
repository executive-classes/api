<?php

namespace Tests\Unit\Models\Eloquent\System\SystemBuglog;

use App\Models\Eloquent\System\SystemBugLog\SystemBugLogFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

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
        $this->assertModelFilter('date');
    }

    public function test_user_filter()
    {
        $this->assertModelFilter('user');
    }

    public function test_app_filter()
    {
        $this->assertModelFilter('app');
    }

    public function test_ajax_filter()
    {
        $this->assertModelFilter('ajax');
    }
}