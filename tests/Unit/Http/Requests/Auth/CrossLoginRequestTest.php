<?php

namespace Tests\Unit\Http\Requests\Auth;

use App\Http\Requests\Auth\CrossLoginRequest;
use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\LanguageRulesAsserts;

class CrossLoginRequestTest extends RequestTestCase
{
    use LanguageRulesAsserts;

    /**
     * @var string
     */
    protected $requestClass = CrossLoginRequest::class;

    public function test_user_id_field()
    {
        $field = 'user_id';

        $this->shouldValidateExists('user', 'id', 123);
        $this->shouldValidateExists('user', 'id', 1234, false);

        $this->assertPasses($field, [$field => 123]);

        $this->assertNotPasses($field, [$field => 1234]);
        $this->assertNotPasses($field, [$field => 'invalid id']);
        $this->assertNotPasses($field, [$field => null]);
        $this->assertNotPasses($field, []);
    }
}