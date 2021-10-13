<?php

namespace Tests\Feature\Billing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Http\Resources\Billing\AddressCountry\AddressCountryCollection;

class AddressCountryTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('country.index'));
    }

    public function test_country_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('country.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}