<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class BillerStatusTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('biller.status.index'));
    }

    public function test_biller_status_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('biller.status.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}
