<?php

namespace Tests\Unit\Http\Requests\System;

use App\Http\Requests\System\GetBugLogRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class GetBugLogRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = GetBugLogRequest::class;

    public function test_limit_field()
    {
        $field = 'limit';

        $this->assertPasses($field, [$field => '500']);
        $this->assertSometimesRule($field);
        $this->assertNumericRule($field);
        $this->assertMaxIntRule($field, 1000);
        $this->assertNotNullableRule($field);
    }

    public function test_paginate_field()
    {
        $field = 'paginate';

        $this->assertPasses($field, [$field => '30']);
        $this->assertSometimesRule($field);
        $this->assertNumericRule($field);
        $this->assertMinIntRule($field, 5);
        $this->assertMaxIntRule($field, 100);
        $this->assertNotNullableRule($field);
    }
}