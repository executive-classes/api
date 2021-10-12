<?php

namespace Tests\Unit\Models\Eloquent;

use App\Exceptions\Tests\TestCaseException;
use Tests\TestCase;

class FilterTestCase extends TestCase
{
    /**
     * @var \App\Filters\QueryFilter
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass;

    /**
     * Test Set Up.
     *
     * @return void
     * @throws TestCaseException
     */
    public function setUp(): void
    {
        parent::setUp();

        if (empty($this->filterClass)) {
            throw new TestCaseException("Model class is not defined");
        }
        
        $this->filter = new $this->filterClass;
    }

    /**
     * Assert a model filter
     *
     * @param string $name
     * @return void
     */
    public function assertModelFilter(string $name)
    {
        $this->assertHasMethod($this->filter, $name);
    }
}