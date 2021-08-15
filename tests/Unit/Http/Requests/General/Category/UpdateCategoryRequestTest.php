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
        $this->assertPasses('name', 'valid name');
        $this->assertNotPasses('name', 'ab');
        $this->assertNotPasses('name', null);
    }

    public function test_description_field()
    {
        $this->assertPasses('description', 'valid description');
        $this->assertPasses('description', null);
    }

    public function test_category_type_id_field()
    {
        foreach (CategoryTypeEnum::getValues() as $value) {
            $this->assertPasses('category_type_id', $value);
        }

        $this->assertNotPasses('category_type_id', 'invalid type');
        $this->assertNotPasses('category_type_id', null);
    }

    public function test_parent_id_field()
    {
        $this->shouldValidateExists('category', 'id', 123);
        $this->shouldValidateExists('category', 'id', 1234, false);

        $this->assertPasses('parent_id', 123);
        $this->assertPasses('parent_id', null);
        $this->assertNotPasses('parent_id', 1234);
        $this->assertNotPasses('parent_id', 'invalid id');
    }
}
