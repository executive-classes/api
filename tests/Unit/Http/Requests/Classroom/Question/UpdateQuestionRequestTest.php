<?php

namespace Tests\Unit\Http\Requests\Classroom\Question;

use App\Http\Requests\Classroom\Question\UpdateQuestionRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class UpdateQuestionRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = UpdateQuestionRequest::class;

    public function test_name_field()
    {
        $field = 'name';

        $this->assertPasses($field, [$field => 'valid name']);
        $this->assertSometimesRule($field);
        $this->assertMinStringRule($field, 3);
        $this->assertNotNullableRule($field);
    }

    public function test_question_field()
    {
        $field = 'question';

        $this->assertPasses($field, [$field => 'valid question']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
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