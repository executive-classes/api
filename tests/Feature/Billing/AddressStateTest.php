<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class AddressStateTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('state.index'));
    }

    public function test_state_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('state.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}