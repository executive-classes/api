<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class PaymentMethodTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('payments.methods.index'));
    }

    public function test_payments_methods_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('payments.methods.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }   
}