<?php

use App\Services\Billing\Password\Password;
use Tests\TestCase;

class PasswordTest extends TestCase
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

    public function test_can_validate_password()
    {
        $this->assertTrue(Password::validate(config('test.user.password')), 'valid_password');
        $this->assertFalse(Password::validate('11'), 'invalid_password');
    }

    public function test_can_generate_password()
    {
        $this->assertIsString(Password::generate(), 'can_generate_string');
        $this->assertTrue(Password::validate(Password::generate()), 'can_generate_valid_password');
    }
}
