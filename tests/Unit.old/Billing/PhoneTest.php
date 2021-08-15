<?php

namespace Tests\Unit\Billing;

use App\Services\Billing\Phone\BrazillianPhone;
use Tests\Providers\Billing\PhoneProvider;
use Tests\TestCase;

class PhoneTest extends TestCase
{
    use PhoneProvider; 
    
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
     * The if brazillian phone can be validated.
     *
     * @dataProvider getValidBrazillianPhone
     * 
     * @param string $phone
     * @param string $formatted_phone
     * @return void
     */
    public function test_can_validate_brazillian_phone(string $phone, string $formatted_phone)
    {
        $this->assertTrue(BrazillianPhone::validate($phone));
        $this->assertTrue(BrazillianPhone::validate($formatted_phone));
    }

    /**
     * The if invalid brazillian phone can be validated.
     *
     * @dataProvider getInvalidBrazillianPhone
     *
     * @param string $phone
     * @param string $formatted_phone
     * @return void
     */
    public function test_can_validate_invalid_brazillian_phone(string $phone, string $formatted_phone)
    {
        $this->assertFalse(BrazillianPhone::validate($phone));
        $this->assertFalse(BrazillianPhone::validate($formatted_phone));
    }

    /**
     * Undocumented function
     *
     * @dataProvider getValidBrazillianPhone
     * 
     * @param string $phone
     * @param string $formatted_phone
     * @return void
     */
    public function test_can_format_brazillian_phone(string $phone, string $formatted_phone)
    {
        $this->assertEquals($formatted_phone, BrazillianPhone::format($phone));
    }
}
