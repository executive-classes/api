<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class PaymentIntervalTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('payments.interval.index'));
    }

    public function test_payments_interval_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('payments.interval.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}