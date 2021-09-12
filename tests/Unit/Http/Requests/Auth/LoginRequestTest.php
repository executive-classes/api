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

    public function test_email_field()
    {
        $field = 'email';

        $this->shouldValidateExists('user', 'email', 'valid@email.com');
        $this->shouldValidateExists('user', 'email', 'invalid@email.com', false);

        $this->assertPasses($field, [$field => 'valid@email.com']);

        $this->assertNotPasses($field, [$field => 'invalid@email.com']);
        $this->assertNotPasses($field, [$field => 'invalid email']);
        $this->assertNotPasses($field, [$field => null]);
        $this->assertNotPasses($field, []);
    }

    public function test_password_field()
    {
        $field = 'password';
        $this->assertPasses($field, [$field => 'password']);

        $this->assertNotPasses($field, [$field => null]);
        $this->assertNotPasses($field, []);
    }

    public function test_remember_me_field()
    {
        $field = 'remember_me';
        $this->assertPasses($field, [$field => true]);
        $this->assertPasses($field, [$field => false]);
        $this->assertPasses($field, []);

        $this->assertNotPasses($field, [$field => 'ab']);
        $this->assertNotPasses($field, [$field => null]);
    }
}