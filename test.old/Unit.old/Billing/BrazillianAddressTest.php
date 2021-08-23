<?php

namespace Tests\Unit\Billing;

use App\Support\Api\ViaCep\ViaCepClient;
use App\Enums\Billing\CountryEnum;
use App\Models\Eloquent\Billing\Address\Address;
use App\Services\Billing\Address\Countries\BrazillianAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrazillianAddressTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * The Brazillian Address service.
     * 
     * @var BrazillianAddress
     */
    protected $service;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = new BrazillianAddress(new ViaCepClient);
    }

    /**
     * Test if a brazillian address can be created.
     *
     * @return void
     */
    public function test_brazillian_address_can_be_created()
    {
        $data = [
            'zip' => '01001000',
            'number' => $this->faker()->buildingNumber
        ];

        $address = $this->service->create($data);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($data['zip'], $address->zip);
        $this->assertEquals(CountryEnum::BR, $address->country);
    }

    /**
     * Test if a brazillian address can be updated.
     *
     * @return void
     */
    public function test_brazillian_address_can_be_updated()
    {
        $data = [
            'zip' => '01001000',
            'number' => $this->faker()->buildingNumber
        ];
        $address = Address::factory()->create();

        $address = $this->service->update($data, $address);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($data['zip'], $address->zip);
        $this->assertEquals(CountryEnum::BR, $address->country);
    }
    
}
