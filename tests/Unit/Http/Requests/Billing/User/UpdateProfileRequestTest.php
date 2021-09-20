<?php

namespace Tests\Unit\Http\Requests\Billing\User;

use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\TaxRulesAsserts;
use Tests\Unit\Traits\Requests\PhoneRulesAsserts;
use Tests\Unit\Traits\Requests\LanguageRulesAsserts;
use App\Http\Requests\Billing\User\UpdateProfileRequest;
use App\Services\Billing\Password\Password;

class UpdateProfileRequestTest extends RequestTestCase
{
    use TaxRulesAsserts;
    use PhoneRulesAsserts;
    use LanguageRulesAsserts;

    /**
     * @var string
     */
    protected $requestClass = UpdateProfileRequest::class;

    /**
     * @var boolean
     */
    protected $changeLanguage = true;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'some name']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_email_field()
    {
        $field = 'email';

        $this->assertSometimesRule($field);
        $this->assertEmailRule($field);
        $this->assertNotNullableRule($field);
        $this->assertUniqueRule($field, 'user', 'email', 'email@domain.com', 'otheremail@domain.com');
    }

    public function test_password_field()
    {
        $field = 'password';

        $this->assertPasses($field, [$field => Password::generate()]);
        $this->assertSometimesRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_password_reminder_field()
    {
        $field = 'password_reminder';

        $this->assertPasses($field, [$field => 'some reminder']);
        $this->assertSometimesRule($field);
        $this->assertNullableRule($field);
    }
}