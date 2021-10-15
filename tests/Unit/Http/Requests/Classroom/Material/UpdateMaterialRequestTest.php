<?php

namespace Tests\Unit\Http\Requests\Classroom\Material;

use App\Http\Requests\Classroom\Material\UpdateMaterialRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class UpdateMaterialRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = UpdateMaterialRequest::class;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'valid name']);
        $this->assertSometimesRule($field);
        $this->assertMinStringRule($field, 3);
        $this->assertNotNullableRule($field);
    }

    public function test_title_field()
    {
        $field = 'title';

        $this->assertPasses($field, [$field => 'valid title']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_content_field()
    {
        $field = 'content';

        $this->assertPasses($field, [$field => 'valid content']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_style_field()
    {
        $field = 'style';

        $this->assertPasses($field, [$field => 'valid style']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNullableRule($field);
    }

    public function test_category_id_field()
    {
        $field = 'category_id';
        
        $this->assertSometimesRule($field);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
        $this->assertExistsRule($field,'category', 'id', 123, 1234);
    }
}