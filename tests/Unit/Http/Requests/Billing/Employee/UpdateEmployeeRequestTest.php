<?php

namespace Tests\Unit\Http\Requests\Billing\Employee;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Enums\Billing\EmployeePositionEnum;
use Tests\Unit\Http\Requests\RequestTestCase;
use App\Http\Requests\Billing\Employee\UpdateEmployeeRequest;

class UpdateEmployeeRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = UpdateEmployeeRequest::class;

    public function test_employee_status_id_field()
    {
        $field = 'employee_status_id';

        $this->assertSometimesRule($field);
        $this->assertEnumRule($field, EmployeeStatusEnum::getUpdatableValues());
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_employee_position_id_field()
    {
        $field = 'employee_position_id';

        $this->assertSometimesRule($field);
        $this->assertEnumRule($field, EmployeePositionEnum::getValues());
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }
}