<?php

namespace Tests\Unit\Filters\General;

use App\Filters\General\CategoryFilter;
use Tests\TestCase;

class CategoryFilterTest extends TestCase
{
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->filter = new CategoryFilter();
    }

    public function test_category_filter()
    {
        $this->assertHasMethod($this->filter, 'type');
    }
}