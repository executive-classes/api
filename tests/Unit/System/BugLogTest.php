<?php

namespace Tests\Unit\System;

use App\Services\System\BugLogService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Providers\System\BugLogProvider;
use Tests\Providers\System\RequestProvider;
use Tests\TestCase;
use Tests\UseUsers;

use function PHPUnit\Framework\assertContains;

class BugLogTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers, BugLogProvider, RequestProvider;

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
     * Test if a exception can be logged with request info.
     *
     * @dataProvider getException
     * 
     * @param callable $provider
     * @return void
     */
    public function test_exception_can_log_request_info(callable $provider)
    {
        [$exception, $request] = $provider();

        $bug = BugLogService::log($request, $exception);

        $this->assertDatabaseHas('system_buglog', ['id' => $bug->id]);
        $this->assertEquals($bug->agent, $request->userAgent());
        $this->assertEquals($bug->url, $request->fullUrl());
        $this->assertEquals($bug->method, $request->method());
        $this->assertEquals($bug->route, $request->getRequestUri());
        $this->assertIsBool($bug->ajax);
    }

    /**
     * Test if a exception can be logged with exception data.
     * 
     * @dataProvider getException
     *
     * @param callable $provider
     * @return void
     */
    public function test_exception_can_log_exception_data(callable $provider)
    {
        [$exception, $request] = $provider();

        $bug = BugLogService::log($request, $exception);

        $this->assertDatabaseHas('system_buglog', ['id' => $bug->id]);
        $this->assertContainsEquals($exception->getMessage(), json_decode($bug->error, true));
        $this->assertContainsEquals($exception->getCode(), json_decode($bug->error, true));
        $this->assertContainsEquals($exception->getFile(), json_decode($bug->error, true));
        $this->assertContainsEquals($exception->getLine(), json_decode($bug->error, true));
        $this->assertContainsEquals($exception->getTrace(), json_decode($bug->error, true));
    }

    /**
     * Test if a exception can be logged with user info.
     *
     * @dataProvider getExceptionWithAuth
     * 
     * @return void
     */
    public function test_exception_can_log_users(callable $provider)
    {
        [$exception, $request] = $provider();
        $user = $request->user();

        $bug = BugLogService::log($request, $exception);

        $this->assertDatabaseHas('system_buglog', ['id' => $bug->id]);
        $this->assertEquals($user ? $user->id : null, $bug->user_id);
        $this->assertEquals($user ? $user->crossId() : null, $bug->cross_user_id);
    }

    /**
     * Test if a exception can be logged with request data.
     *
     * @dataProvider getExceptionWithRequestData
     * 
     * @param callable $provider
     * @return void
     */
    public function test_exception_can_log_request_data(callable $provider)
    {
        [$exception, $request] = $provider();

        $bug = BugLogService::log($request, $exception);

        $this->assertDatabaseHas('system_buglog', ['id' => $bug->id]);

        foreach ($request->all() as $param) {
            $this->assertContains($param, json_decode($bug->data, true));
        }

        $route = $request->route();
        foreach ($route ? $route->parameters() : [] as $param) {
            $this->assertContains($param, json_decode($bug->data, true));
        }
    }

}
