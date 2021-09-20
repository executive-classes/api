<?php

namespace Tests\Unit\Http\Requests\Billing\Employee;

use App\Enums\Billing\EmployeePositionEnum;
use Tests\Unit\Http\Requests\RequestTestCase;
use App\Http\Requests\Billing\Employee\CreateEmployeeRequest;

class CreateEmployeeRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = CreateEmployeeRequest::class;

    public function test_user_id_field()
    {
        $field = 'user_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'user', 'id', 123, 1234);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_employee_position_id_field()
    {
        $field = 'employee_position_id';

        $this->assertRequiredRule($field);
        $this->assertEnumRule($field, EmployeePositionEnum::getValues());
        $this->assertStringRule($field, [$field => 1234]);
        $this->assertNotNullableRule($field);
    }
}