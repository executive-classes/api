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
        $this->assertPasses($field, []);

        $this->assertNotPasses($field, [$field => 'ab']);
        $this->assertNotPasses($field, [$field => null]);
    }

    public function test_description_field()
    {
        $field = 'description';

        $this->assertPasses($field, [$field => 'valid description']);
        $this->assertPasses($field, [$field => null]);
        $this->assertPasses($field, []);
    }

    public function test_category_type_id_field()
    {
        $field = 'category_type_id';

        foreach (CategoryTypeEnum::getValues() as $value) {
            $this->assertPasses($field, [$field => $value]);
        }
        $this->assertPasses($field, []);

        $this->assertNotPasses($field, [$field => 'invalid type']);
        $this->assertNotPasses($field, [$field => null]);
    }

    public function test_parent_id_field()
    {
        $this->shouldValidateExists('category', 'id', 123);
        $this->shouldValidateExists('category', 'id', 1234, false);

        $field = 'parent_id';

        $this->assertPasses($field, [$field => 123]);
        $this->assertPasses($field, [$field => null]);
        $this->assertPasses($field, []);

        $this->assertNotPasses($field, [$field => 1234]);
        $this->assertNotPasses($field, [$field => 'invalid id']);
    }
}
