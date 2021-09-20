<?php

namespace Tests\Unit\Http\Requests\Billing\Biller;

use App\Http\Requests\Billing\Biller\CreateBillerRequest;
use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\EmailRulesAsserts;
use Tests\Unit\Traits\Requests\PhoneRulesAsserts;
use Tests\Unit\Traits\Requests\TaxRulesAsserts;

class CreateBillerRequestTest extends RequestTestCase
{
    use TaxRulesAsserts;
    use PhoneRulesAsserts;
    use EmailRulesAsserts;

    /**
     * @var string
     */
    protected $requestClass = CreateBillerRequest::class;

    public function test_customer_id_field()
    {
        $field = 'customer_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'customer', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

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

    public function test_payment_interval_id_field()
    {
        $field = 'payment_interval_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'payment_interval', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_payment_method_id_field()
    {
        $field = 'payment_method_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'payment_method', 'id', 'some id', 'some invalid id');
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }
}