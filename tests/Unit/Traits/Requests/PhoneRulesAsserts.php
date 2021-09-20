<?php

namespace Tests\Unit\Traits\Requests;

trait PhoneRulesAsserts
{
    public function test_phone_field()
    {
        $field = 'phone';

        $this->assertRequiredRule($field, $this->checkRequiredAdditionalRule('phone'));
        $this->assertNotNullableRule($field);
        $this->assertPasses($field, [$field => '(47) 2687-6418']);
        $this->assertPasses($field, [$field => '4726876418']);
        $this->assertPasses($field, [$field => '(47) 99181-3066']);
        $this->assertPasses($field, [$field => '47991813066']);
        $this->assertNotPasses($field, [$field => 'invalid value']);
    }

    public function test_phone_alt_field()
    {
        $field = 'phone_alt';

        $this->assertSometimesRule($field, []);
        $this->assertNullableRule($field, [$field => null]);
        $this->assertPasses($field, [$field => '202-555-0153']);
        $this->assertPasses($field, [$field => '2025550153']);
    }
}