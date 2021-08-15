<?php

namespace Tests\Providers\System;

use App\Models\Billing\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * @requires \Illuminate\Foundation\Testing\WithFaker
 * @requires \Tests\UseUsers
 */
trait RequestProvider
{
    public function makeRequest(bool $authenticate = false, bool $crossAuthenticate = false, bool $makeRouteData = false, bool $makeData = false): Request
    {
        $this->createApplication();
        $this->setUpFaker();

        $request = request();
        $route = $this->makeRoute()->bind($request);
        
        $request->setRouteResolver(function () use ($route) {
            return $route;
        });

        if ($authenticate) {
            $this->requestAuthenticate($crossAuthenticate);
        }

        if ($makeRouteData) {
            $route->setParameter($this->faker()->word(), $this->faker()->word());
        }

        if ($makeData) {
            $request->merge([$this->faker()->word() => $this->faker()->word()]);
        }

        return $request;
    }

    private function requestAuthenticate(bool $crossAuthenticate = false)
    {
        $user = $this->getDevUser();

        $crossAuthenticate
            ? User::factory()->create()->crossLogin($user)
            : $user->login();
    }

    private function makeRoute()
    {
        return (new Route('GET', $this->faker()->word(), function ($id) {}))->name('test');
    }
}