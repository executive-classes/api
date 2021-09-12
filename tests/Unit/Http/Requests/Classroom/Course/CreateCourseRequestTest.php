<?php

namespace Tests\Unit\Http\Requests\Classroom;

use App\Http\Requests\Classroom\Course\CreateCourseRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class CourseRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = CreateCourseRequest::class;

    public function test_name_field()
    {
        $field = 'name';
        $this->assertPasses($field, [$field => 'valid name']);

        $this->assertNotPasses($field, [$field => 'ab']);
        $this->assertNotPasses($field, [$field => null]);
        $this->assertNotPasses($field, []);
    }

    public function test_category_id_field()
    {
        $this->shouldValidateExists('category', 'id', 123);
        $this->shouldValidateExists('category', 'id', 1234, false);

        $field = 'category_id';

        $this->assertPasses($field, [$field => 123]);

        $this->assertNotPasses($field, [$field => 1234]);
        $this->assertNotPasses($field, [$field => 'invalid id']);
        $this->assertNotPasses($field, []);
    }
}