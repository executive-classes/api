<?php

namespace Tests\Unit\Http\Requests\Billing\Student;

use App\Http\Requests\Billing\Student\CreateStudentRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class CreateStudentRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = CreateStudentRequest::class;

    public function test_customer_id_field()
    {
        $field = 'customer_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'customer', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_biller_id_field()
    {
        $field = 'biller_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'biller', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_user_id_field()
    {
        $field = 'user_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'user', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }
}