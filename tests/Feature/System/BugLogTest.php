<?php

namespace Tests\Feature\System;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class BugLogTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('logs.bugs.index'));
    }

    public function test_logs_bugs_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('logs.bugs.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}