<?php

namespace Tests\Unit\Http\Requests\Billing\Student;

use App\Enums\Billing\StudentStatusEnum;
use Tests\Unit\Http\Requests\RequestTestCase;
use App\Http\Requests\Billing\Student\UpdateStudentRequest;

class UpdateStudentRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = UpdateStudentRequest::class;

    public function test_customer_id_field()
    {
        $field = 'customer_id';

        $this->assertSometimesRule($field);
        $this->assertExistsRule($field, 'customer', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_biller_id_field()
    {
        $field = 'biller_id';

        $this->assertRequiredWithRule($field, ['customer_id' => 123]);
        $this->assertExistsRule($field, 'biller', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_student_status_id_field()
    {
        $field = 'student_status_id';

        $this->assertSometimesRule($field);
        $this->assertEnumRule($field, StudentStatusEnum::getUpdatableValues());
        $this->assertStringRule($field, [$field => 1234]);
        $this->assertNotNullableRule($field, [$field => null]);
    }
}