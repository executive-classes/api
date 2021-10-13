<?php

namespace Tests\Feature\Billing;

use App\Models\Eloquent\Billing\Address\Address;
use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class AddressTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('address.index'));
        $this->assertAuthenticationRequired(route('address.store'), 'POST');
        $this->assertAuthenticationRequired(route('address.search', ['cep' => config('test.viacep.cep')]));
        $this->assertAuthenticationRequired(route('address.show', ['address' => 1]));
        $this->assertAuthenticationRequired(route('address.update', ['address' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('address.destroy', ['address' => 1]), 'DELETE');
    }

    public function test_address_index()
    {
        // Data creation
        $this->createMany(Address::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('address.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_address_store()
    {
        // Data creation
        $address = $this->makeOne(Address::class, true);
        $data = collect($address->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('address.store'), $address->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('address', $data->only(['zip'])->toArray());
    }

    public function test_address_search()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('address.search', ['cep' => config('test.viacep.cep')]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_address_show()
    {
        // Data creation
        $address = $this->createOne(Address::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('address.show', ['address' => $address->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_address_update()
    {
        // Data creation
        $address = $this->createOne(Address::class);
        $newAddress = $this->makeOne(Address::class, true);
        $data = collect($newAddress->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('address.update', ['address' => $address->id]), 
                $newAddress->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('address', $data->only(['zip'])->toArray());
    }

    public function test_address_destroy()
    {
        // Data creation
        $address = $this->createOne(Address::class);
        $data = collect($address->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('address.destroy', ['address' => $address->id]));

        // Assertions
        $this->assertResponseJson($response, 204);
        $this->assertDatabaseMissing('address', $data->only(['id'])->toArray());
    }
}