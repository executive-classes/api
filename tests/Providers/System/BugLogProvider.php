<?php

namespace Tests\Providers\System;

use Closure;
use Exception;

/**
 * @requires \Illuminate\Foundation\Testing\WithFaker
 * @requires \Tests\Providers\System\RequestProvider
 */
trait BugLogProvider
{
    /**
     * Providers
     */

    public function getException()
    {
        return [
            [ $this->getBugLogInfoFunction() ]
        ];
    }
    
    public function getExceptionWithAuthentication()
    {
        return [
            'without-user' => [
                $this->getBugLogInfoFunction()
            ],
            'with-user' => [
                $this->getBugLogInfoFunction(true)
            ],
            'with-cross-user' => [
                $this->getBugLogInfoFunction(true, true)
            ]
        ];
    }

    public function getExceptionWithRequestData()
    {
        return [
            'without-data' => [
                $this->getBugLogInfoFunction()
            ],
            'with-request-data' => [
                $this->getBugLogInfoFunction(false, false, false, true)
            ],
            'with-route-data' => [
                $this->getBugLogInfoFunction(false, false, true)
            ],
            'with-request-and-route-data' => [
                $this->getBugLogInfoFunction(false, false, true, true)
            ]
        ];
    }

    /**
     * Providers Functions
     */

    private function getBugLogInfoFunction(
        bool $authenticate = false, 
        bool $crossAuthenticate = false, 
        bool $makeRouteData = false, 
        bool $makeData = false
    ): Closure {
        return function () use ($authenticate, $crossAuthenticate, $makeRouteData, $makeData) { 
            return [
                $this->makeException(), 
                $this->makeRequest($authenticate, $crossAuthenticate, $makeRouteData, $makeData)
            ]; 
        };
    }

    /**
     * Makers
     */

    public function makeException()
    {
        $this->createApplication();
        $this->setUpFaker();

        return new Exception(
            $this->faker()->text(),
            $this->faker()->randomNumber(1)
        );
    }
}