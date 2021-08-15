<?php

namespace Tests\Providers\System;

use Closure;
use Symfony\Component\HttpFoundation\Response;

trait AccessLogProvider
{
    /**
     * Providers
     */

    public function getAccess()
    {
        return [
            [ $this->getAccessFunction() ]
        ];
    }

    public function getAccessWithAutentication()
    {
        return [
            'without-user' => [
                $this->getAccessWithAutenticationFunction()
            ],
            'with-user' => [
                $this->getAccessWithAutenticationFunction(true)
            ],
            'with-cross-user' => [
                $this->getAccessWithAutenticationFunction(true, true)
            ]
        ];
    }
    
    /**
     * Providers Functions
     */

    private function getAccessFunction(): Closure 
    {
        return function () { 
            return [ $this->makeRequest(), $this->makeResponse() ]; 
        };
    }

    private function getAccessWithAutenticationFunction(bool $authenticate = false, bool $crossAuthenticate = false): Closure 
    {
        return function () use ($authenticate, $crossAuthenticate) { 
            return [ $this->makeRequest($authenticate, $crossAuthenticate), $this->makeResponse() ]; 
        };
    }

    /**
     * Makers
     */

    public function makeResponse()
    {
        return new Response('', 200);
    }
}
