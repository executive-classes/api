<?php

namespace Tests\Feature\Billing;

use App\Enums\Billing\CustomerStatusEnum;
use App\Models\Billing\Customer\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class CustomerRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->getDevUser()->login();
        Customer::factory()->count(3)->create();
    }

    public function test_can_list_customers()
    {
        $response = $this->getJson(route('customer.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Customer::count(), 'data');
    }

    public function test_can_filter_customer_list()
    {
        $taxCode = Customer::first()->tax_code;
        $response = $this->getJson(route('customer.index', ['taxCode' => $taxCode]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Customer::where('tax_code', $taxCode)->count(), 'data');
    }

    public function test_can_get_customer()
    {
        $id = Customer::first()->id;
        $response = $this->getJson(route('customer.show', ['customer' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
    }

    public function test_can_create_customer()
    {
        $data = Customer::factory()->make()->toArray();
        $response = $this->postJson(route('customer.store'), $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.name', $data['name']);
    }

    public function test_can_update_customer()
    {
        $data = Customer::factory()->make()->toArray();
        $id = Customer::first()->id;
        $response = $this->putJson(route('customer.update', ['customer' => $id]), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.name', $data['name']);
    }

    public function test_can_not_cancel_customer_by_update()
    {
        $data = ['customer_status_id' => CustomerStatusEnum::CANCELED];
        $id = Customer::first()->id;
        $response = $this->putJson(route('customer.update', ['customer' => $id]), $data);

        $response->assertStatus(422);
    }

    public function test_can_cancel_customer()
    {
        $id = Customer::first()->id;
        $response = $this->deleteJson(route('customer.cancel', ['customer' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.status.id', CustomerStatusEnum::CANCELED);
    }
}
