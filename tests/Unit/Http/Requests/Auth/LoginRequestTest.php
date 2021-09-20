<?php

namespace Tests\Unit\Http\Requests\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\LanguageRulesAsserts;

class LoginRequestTest extends RequestTestCase
{
    use LanguageRulesAsserts;

    /**
     * @var string
     */
    protected $requestClass = LoginRequest::class;

    /**
     * @var boolean
     */
    protected $changeLanguage = true;

    public function test_email_field()
    {
        $field = 'email';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'user', 'email', 'valid@email.com', 'invalid@email.com');
        $this->assertEmailRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_password_field()
    {
        $field = 'password';

        $this->assertPasses($field, [$field => 'password']);
        $this->assertRequiredRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_remember_me_field()
    {
        $field = 'remember_me';

        $this->assertSometimesRule($field);
        $this->assertBooleanRule($field);
        $this->assertNotNullableRule($field);
    }
}