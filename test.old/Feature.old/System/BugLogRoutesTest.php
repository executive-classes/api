<?php

namespace Tests\Feature\System;

use App\Models\System\SystemBugLog\SystemBugLog;
use App\Services\System\BugLogService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class BugLogRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

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
        
        $this->getDevUser()->login();
        BugLogService::log(request(), new Exception());
    }

    public function test_can_list_bug_logs()
    {
        $response = $this->getJson(route('logs.bugs.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(SystemBugLog::count(), 'data');
    }

    // public function test_can_paginate_bug_logs()
    // {
    //     $per_page = 40;
    //     $response = $this->getJson(route('logs.bugs.index', ['paginate' => $per_page]));

    //     $response->assertOk();
    //     $response->assertJsonStructure([
    //         'status',
    //         'data'
    //     ]);
    //     $response->assertJsonPath('status', true);
    //     $response->assertJsonPath('meta.per_page', "$per_page");
    // }

    public function test_can_filter_bug_log_list()
    {
        $date = SystemBugLog::first()->date;
        $response = $this->getJson(route('logs.bugs.index', ['date' => $date]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(SystemBugLog::where('date', '>=', $date)->count(), 'data');
    }

    
}
