<?php

namespace Tests\Unit\Billing;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Billing\Address;
use App\Services\Billing\Address\AddressFormatter;

class AddressFormatterTest extends TestCase
{
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test if a address can be formatted.
     *
     * @return void
     */
    public function test_address_can_be_formatted()
    {
        $address = Address::factory()->br()->make();

        $formattedAddress = AddressFormatter::format($address);

        $city = Str::upper($address->city);
        $this->assertEquals(
            "{$address->street}, {$address->number} / {$address->district} / {$city}-{$address->state} / {$address->zip}",
            $formattedAddress
        );
    }
}
