<?php

namespace Tests\Feature\Billing;

use App\Models\Billing\Address;
use App\Services\Billing\Address\AddressFormatter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class AddressRoutesTest extends TestCase
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
        Address::factory()->count(3)->create();
    }

    public function test_can_list_addresses()
    {
        $response = $this->getJson(route('address.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Address::count(), 'data');
    }

    public function test_can_filter_address_list()
    {
        $zip = Address::first()->zip;
        $response = $this->getJson(route('address.index', ['zip' => $zip]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Address::where('zip', $zip)->count(), 'data');
    }

    public function test_can_get_address()
    {
        $address = Address::first();
        $id = $address->id;
        $response = $this->getJson(route('address.show', ['address' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.full_address', AddressFormatter::format($address));
    }

    public function test_can_create_address()
    {
        $data = [
            'zip' => '01001-000',
            'number' => $this->faker()->buildingNumber
        ];
        $response = $this->postJson(route('address.store'), $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.zip', $data['zip']);
    }

    public function test_can_update_address()
    {
        $data = [
            'zip' => '01001-000',
            'number' => $this->faker()->buildingNumber
        ];
        $id = Address::first()->id;
        $response = $this->putJson(route('address.update', ['address' => $id]), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.zip', $data['zip']);
    }

    public function test_can_delete_address()
    {
        $id = Address::first()->id;
        $response = $this->deleteJson(route('address.destroy', ['address' => $id]));

        $response->assertNoContent();
        $this->assertDatabaseMissing('address', ['id' => $id]);
    }
}
