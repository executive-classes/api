<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Assert that a class had a method.
     *
     * @param string $class
     * @param string $method
     * @param string $message
     * @return void
     */
    public function assertHasMethod($class, string $method, string $message = '')
    {
        if (is_object($class)) {
            $class = get_class($class);
        }
        
        if (empty($message)) {
            $message = "The Class doesn't had the method $method";
        }

        $this->assertTrue(method_exists($class, $method), $message);
    }
}
