<?php

namespace Tests\Unit\Http\Requests\Classroom\Material;

use App\Http\Requests\Classroom\Material\CreateMaterialRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class CreateMaterialRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = CreateMaterialRequest::class;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'valid name']);
        $this->assertRequiredRule($field);
        $this->assertMinStringRule($field, 3);
        $this->assertNotNullableRule($field);
    }

    public function test_title_field()
    {
        $field = 'title';

        $this->assertPasses($field, [$field => 'valid title']);
        $this->assertRequiredRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_content_field()
    {
        $field = 'content';

        $this->assertPasses($field, [$field => 'valid content']);
        $this->assertRequiredRule($field);
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

        $this->assertRequiredRule($field);
        $this->assertNumericRule($field);
        $this->assertNotNullableRule($field);
        $this->assertExistsRule($field, 'category', 'id', 123, 1234);
    }
}