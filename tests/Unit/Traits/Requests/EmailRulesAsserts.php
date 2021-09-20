<?php

namespace Tests\Unit\Traits\Requests;

trait EmailRulesAsserts
{
    public function test_email_field()
    {
        $field = 'email';

        $this->assertRequiredRule($field, $this->checkRequiredAdditionalRule('email'));
        $this->assertEmailRule($field);
        $this->assertNullableRule($field);
        $this->assertPasses($field, [$field => 'email@domain.com']);
    }
}