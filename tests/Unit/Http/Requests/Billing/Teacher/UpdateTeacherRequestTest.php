<?php

namespace Tests\Unit\Http\Requests\Billing\Teacher;

use App\Enums\Billing\TeacherStatusEnum;
use Tests\Unit\Http\Requests\RequestTestCase;
use App\Http\Requests\Billing\Teacher\UpdateTeacherRequest;

class UpdateTeacherRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = UpdateTeacherRequest::class;

    public function test_teacher_status_id_field()
    {
        $field = 'teacher_status_id';

        $this->assertSometimesRule($field);
        $this->assertEnumRule($field, TeacherStatusEnum::getUpdatableValues());
        $this->assertStringRule($field, [$field => 1234]);
        $this->assertNotNullableRule($field, [$field => null]);
    }
}