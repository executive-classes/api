<?php

namespace Tests\Unit\Http\Requests\Classroom\Test;

use App\Http\Requests\Classroom\Test\CreateTestRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class CreateTestRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = CreateTestRequest::class;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'valid name']);
        $this->assertRequiredRule($field);
        $this->assertMinStringRule($field, 3);
        $this->assertNotNullableRule($field);
    }

    public function test_category_id_field()
    {
        $field = 'category_id';

        $this->assertRequiredRule($field);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
        $this->assertExistsRule($field, 'category', 'id', 123, 1234);
    }
}