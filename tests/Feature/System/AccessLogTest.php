<?php

namespace Tests\Feature\System;

use App\Models\Billing\User;
use App\Models\System\SystemAccessLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class AccessLogTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;
    
    /**
     * The test route
     * 
     * @var string
     */
    protected $uri;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->route = 'test';
    }
    
    public function test_access_create_log()
    {
        $response = $this->get(route($this->route));
        $response->assertOk();

        $this->assertDatabaseHas('system_accesslog', ['route' => $this->route]);

        $log = SystemAccessLog::firstWhere('route', $this->route);
        $this->assertInstanceOf(SystemAccessLog::class, $log);

        $this->assertEquals(200, $log->code);
        $this->assertNull($log->user_id);
    }

    public function test_access_create_log_with_auth()
    {
        $user = $this->getDevUser();

        $user->login();
        $response = $this->get(route($this->route));
        $response->assertOk();

        $this->assertDatabaseHas('system_accesslog', ['route' => $this->route]);

        $log = SystemAccessLog::firstWhere('route', $this->route);
        $this->assertInstanceOf(SystemAccessLog::class, $log);

        $this->assertEquals($user->id, $log->user_id);
    }
}
