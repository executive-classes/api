<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class TaxTypeTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('taxes'));
        $this->assertAuthenticationRequired(route('taxes.validate'), 'POST');
    }

    public function test_taxes()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('taxes'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_taxes_validate()
    {
        // Data creation
        $data = [
            'tax_type_id' => 'cnpj',
            'tax_code' => config('test.tax.cnpj.valid')[0],
        ];

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('taxes.validate'), $data);

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}