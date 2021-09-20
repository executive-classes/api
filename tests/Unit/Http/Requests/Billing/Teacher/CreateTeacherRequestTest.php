<?php

namespace Tests\Unit\Http\Requests\Billing\Teacher;

use App\Http\Requests\Billing\Teacher\CreateTeacherRequest;
use CreateTeacherTable;
use Tests\Unit\Http\Requests\RequestTestCase;

class CreateTeacherRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = CreateTeacherRequest::class;

    public function test_user_id_field()
    {
        $field = 'user_id';

        $this->assertRequiredRule($field);
        $this->assertExistsRule($field, 'user', 'id', 123, 1234);
        $this->assertNumericRule($field, [$field => 'invalid id']);
        $this->assertNotNullableRule($field, [$field => null]);
    }
}