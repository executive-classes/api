<?php

namespace Tests\Unit\Filters\System;

use App\Filters\System\BugLogFilter;
use Tests\Unit\Filters\FilterTestCase;

class BugLogFilterTest extends FilterTestCase
{
    /**
     * @var BugLogFilter
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = BugLogFilter::class;

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