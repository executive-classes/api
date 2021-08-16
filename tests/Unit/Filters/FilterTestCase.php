<?php

namespace Tests\Unit\Filters;

use App\Exceptions\TestCaseException;
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
}