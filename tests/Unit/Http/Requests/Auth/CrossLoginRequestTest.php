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

    /**
     * @var boolean
     */
    protected $changeLanguage = true;

    public function test_user_id_field()
    {
        $field = 'user_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'user', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }
}