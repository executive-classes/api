<?php

namespace Tests\Unit\Http\Requests\General\Category;

use App\Enums\General\CategoryTypeEnum;
use App\Http\Requests\General\Category\UpdateCategoryRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class UpdateCategoryRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = UpdateCategoryRequest::class;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'valid name']);
        $this->assertSometimesRule($field);
        $this->assertMinStringRule($field, 3);
        $this->assertNotNullableRule($field);
    }

    public function test_description_field()
    {
        $field = 'description';

        $this->assertPasses($field, [$field => 'valid description']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_category_type_id_field()
    {
        $field = 'category_type_id';

        $this->assertSometimesRule($field);
        $this->assertEnumRule($field, CategoryTypeEnum::getValues());
        $this->assertNotNullableRule($field);
    }

    public function test_parent_id_field()
    {
        $field = 'parent_id';

        $this->assertSometimesRule($field);
        $this->assertNullableRule($field);
        $this->assertNumericRule($field);
        $this->assertExistsRule($field, 'category', 'id', 123, 1234);
    }
}
