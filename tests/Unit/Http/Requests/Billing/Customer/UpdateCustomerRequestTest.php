<?php

namespace Tests\Unit\Http\Requests\Billing\Customer;

use App\Enums\Billing\CustomerStatusEnum;
use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\TaxRulesAsserts;
use Tests\Unit\Traits\Requests\EmailRulesAsserts;
use Tests\Unit\Traits\Requests\PhoneRulesAsserts;
use App\Http\Requests\Billing\Customer\UpdateCustomerRequest;

class UpdateCustomerRequestTest extends RequestTestCase
{
    use TaxRulesAsserts;
    use PhoneRulesAsserts;
    use EmailRulesAsserts;

    /**
     * @var string
     */
    protected $requestClass = UpdateCustomerRequest::class;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'some name']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_address_id_field()
    {
        $field = 'address_id';

        $this->assertSometimesRule($field);
        $this->assertExistsRule($field, 'address', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_customer_status_id_field()
    {
        $field = 'customer_status_id';

        $this->assertSometimesRule($field);
        $this->assertEnumRule($field, CustomerStatusEnum::getUpdatableValues());
        $this->assertStringRule($field, [$field => 1234]);
        $this->assertNotNullableRule($field, [$field => null]);
    }
}