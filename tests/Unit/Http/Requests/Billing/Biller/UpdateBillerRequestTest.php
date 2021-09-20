<?php

namespace Tests\Unit\Http\Requests\Billing\Biller;

use App\Enums\Billing\BillerStatusEnum;
use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\TaxRulesAsserts;
use Tests\Unit\Traits\Requests\EmailRulesAsserts;
use Tests\Unit\Traits\Requests\PhoneRulesAsserts;
use App\Http\Requests\Billing\Biller\UpdateBillerRequest;

class UpdateBillerRequestTest extends RequestTestCase
{
    use TaxRulesAsserts;
    use PhoneRulesAsserts;
    use EmailRulesAsserts;
    
    /**
     * @var string
     */
    protected $requestClass = UpdateBillerRequest::class;

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

    public function test_payment_interval_id_field()
    {
        $field = 'payment_interval_id';

        $this->assertSometimesRule($field);
        $this->assertExistsRule($field, 'payment_interval', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_payment_method_id_field()
    {
        $field = 'payment_method_id';

        $this->assertSometimesRule($field);
        $this->assertExistsRule($field, 'payment_method', 'id', 'some id', 'some invalid id');
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_biller_status_id_field()
    {
        $field = 'biller_status_id';

        $this->assertSometimesRule($field);
        $this->assertEnumRule($field, BillerStatusEnum::getUpdatableValues());
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }
}