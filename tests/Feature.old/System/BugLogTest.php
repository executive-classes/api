<?php

namespace Tests\Feature\System;

use App\Models\System\SystemBuglog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class BugLogTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * The test URI.
     * 
     * @var String
     */
    protected $uri;

    /**
     * The error throwed by the request.
     * 
     * @var String
     */
    protected $error;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->route = 'test.error';
        $this->error = 'Error';
    }

    public function test_bug_create_log()
    {
        $this->get(route($this->route));

        $this->assertDatabaseHas('system_buglog', ['route' => $this->route]);

        $log = SystemBuglog::firstWhere('route', $this->route);
        $this->assertInstanceOf(SystemBuglog::class, $log);
        
        $this->assertEquals($this->error, json_decode($log->error)->message);
    }

    public function test_bug_create_log_with_auth()
    {
        $user = $this->getDevUser();
        $user->login();

        $this->get(route($this->route));
        $this->assertDatabaseHas('system_buglog', ['route' => $this->route]);

        $log = SystemBuglog::firstWhere('route', $this->route);
        $this->assertInstanceOf(SystemBuglog::class, $log);

        $this->assertEquals($user->id, $log->user_id);
    }
}
