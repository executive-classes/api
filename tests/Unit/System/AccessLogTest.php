<?php

namespace Tests\Unit\System;

use App\Services\System\AccessLogService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Providers\System\AccessLogProvider;
use Tests\Providers\System\RequestProvider;
use Tests\TestCase;
use Tests\UseUsers;

class AccessLogTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers, RequestProvider, AccessLogProvider;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test if a access log can save the user info.
     * 
     * @dataProvider getAccessWithAutentication
     *
     * @param callable $provider
     * @return void
     */
    public function test_access_can_log_user_info(callable $provider)
    {
        [$request, $response] = $provider();
        $user = $request->user();

        $log = AccessLogService::access($request);

        $this->assertDatabaseHas('system_accesslog', ['id' => $log->id]);
        $this->assertEquals($user ? $user->id : null, $log->user_id);
        $this->assertEquals($user ? $user->crossId() : null, $log->cross_user_id);
    }

    /**
     * Test if a access log can save the request info.
     *
     * @dataProvider getAccess
     * 
     * @param callable $provider
     * @return void
     */
    public function test_access_can_log_request_info(callable $provider)
    {
        [$request, $response] = $provider();

        $log = AccessLogService::access($request);

        $this->assertDatabaseHas('system_accesslog', ['id' => $log->id]);
        $this->assertEquals($log->agent, $request->userAgent());
        $this->assertEquals($log->url, $request->fullUrl());
        $this->assertEquals($log->method, $request->method());
        $this->assertEquals($log->route, $request->route()->getName());
        $this->assertIsBool($log->ajax);
    }

    /**
     * Test if a access log can save the response info.
     *
     * @dataProvider getAccess
     * 
     * @param callable $provider
     * @return void
     */
    public function test_access_can_log_response_info(callable $provider)
    {
        [$request, $response] = $provider();

        $log = AccessLogService::access($request);
        $this->assertDatabaseHas('system_accesslog', ['id' => $log->id]);


        AccessLogService::response($log, $response);
        $log->refresh();

        $this->assertEquals($log->code, $response->getStatusCode());
        $this->assertIsBool($log->allowed);
    }

    
}

