<?php

namespace Tests\Feature\System;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class LanguageTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('languages'));
    }

    public function test_languages()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('languages'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}