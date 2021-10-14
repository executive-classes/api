<?php

namespace Tests\Unit\Http\Requests\Classroom\Module;

use Tests\Unit\Http\Requests\RequestTestCase;
use App\Http\Requests\Classroom\Module\UpdateModuleRequest;

class UpdateModuleRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = UpdateModuleRequest::class;

    public function test_course_id_field()
    {
        $field = 'course_id';

        $this->assertSometimesRule($field);
        $this->assertNumericRule($field);
        $this->assertNullableRule($field);
        $this->assertExistsRule($field, 'course', 'id', 123, 1234);
    }

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'valid name']);
        $this->assertSometimesRule($field);
        $this->assertMinStringRule($field, 3);
        $this->assertNotNullableRule($field);
    }

    public function test_category_id_field()
    {
        $field = 'category_id';

        $this->assertSometimesRule($field);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
        $this->assertExistsRule($field, 'category', 'id', 123, 1234);
    }
}