<?php

namespace Tests\Unit\Http\Requests\Billing\Customer;

use App\Http\Requests\Billing\Customer\CreateCustomerRequest;
use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\EmailRulesAsserts;
use Tests\Unit\Traits\Requests\PhoneRulesAsserts;
use Tests\Unit\Traits\Requests\TaxRulesAsserts;

class CreateCustomerRequestTest extends RequestTestCase
{
    use TaxRulesAsserts;
    use PhoneRulesAsserts;
    use EmailRulesAsserts;

    /**
     * @var string
     */
    protected $requestClass = CreateCustomerRequest::class;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'some name']);
        $this->assertRequiredRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_address_id_field()
    {
        $field = 'address_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'address', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }
}