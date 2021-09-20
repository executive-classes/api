<?php

namespace Tests\Unit\Http\Requests\Billing\User;

use App\Http\Requests\Billing\User\CreateUserRequest;
use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\LanguageRulesAsserts;
use Tests\Unit\Traits\Requests\PhoneRulesAsserts;
use Tests\Unit\Traits\Requests\TaxRulesAsserts;

class CreateUserRequestTest extends RequestTestCase
{
    use TaxRulesAsserts;
    use PhoneRulesAsserts;
    use LanguageRulesAsserts;

    /**
     * @var string
     */
    protected $requestClass = CreateUserRequest::class;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'some name']);
        $this->assertRequiredRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_email_field()
    {
        $field = 'email';

        $this->assertRequiredRule($field);
        $this->assertEmailRule($field);
        $this->assertNotNullableRule($field);
        $this->assertUniqueRule($field, 'user', 'email', 'email@domain.com', 'otheremail@domain.com');
    }
}