<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class CustomerStatusTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('customer.status.index'));
    }

    public function test_customer_status_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('customer.status.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}