<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function assertHasMethod($class, $method)
    {
        $message = "Class does not have method $method";
        $this->assertTrue(method_exists($class, $method), $message);
    }
}
