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

    /**
     * Call a method of a class.
     *
     * @param object $obj
     * @param string $name
     * @param array $args
     * @return mixed
     * @source https://stackoverflow.com/questions/249664/best-practices-to-test-protected-methods-with-phpunit
     */
    public function callMethod($obj, $name, array $args = [])
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }
}
