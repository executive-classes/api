<?php

namespace Tests\Feature\Billing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Enums\Billing\CustomerStatusEnum;
use App\Models\Eloquent\Billing\Customer\Customer;

class CustomerTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('customer.index'));
        $this->assertAuthenticationRequired(route('customer.store'), 'POST');
        $this->assertAuthenticationRequired(route('customer.show', ['customer' => 1]));
        $this->assertAuthenticationRequired(route('customer.update', ['customer' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('customer.cancel', ['customer' => 1]), 'DELETE');
    }

    public function test_customer_index()
    {
        // Data creation
        $this->createMany(Customer::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('customer.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_customer_store()
    {
        // Data creation
        $customer = $this->makeOne(Customer::class, true);
        $data = collect($customer->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('customer.store'), $customer->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('customer', $data->only(['name'])->toArray());
    }

    public function test_customer_show()
    {
        // Data creation
        $customer = $this->createOne(Customer::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('customer.show', ['customer' => $customer->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_customer_update()
    {
        // Data creation
        $customer = $this->createOne(Customer::class, true);
        $newCustomer = $this->makeOne(Customer::class, true);
        $data = collect($newCustomer->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(route('customer.update', ['customer' => $customer->id]), $newCustomer->toArray());

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('customer', $data->only(['name'])->toArray());
    }

    public function test_customer_cancel()
    {
        // Data creation
        $customer = $this->createOne(Customer::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('customer.cancel', ['customer' => $customer->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('customer', [
            'id' => $customer->id,
            'customer_status_id' => CustomerStatusEnum::CANCELED
        ]);
    }
}