<?php

namespace Tests\Unit\Http\Requests\Classroom\Course;

use App\Http\Requests\Classroom\Course\UpdateCourseRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class UpdateCourseRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = UpdateCourseRequest::class;

    public function test_name_field()
    {
        $this->assertPasses('name', 'valid name');

        $this->assertNotPasses('name', 'ab');
        $this->assertNotPasses('name', null);
    }

    public function test_category_id_field()
    {
        $this->shouldValidateExists('category', 'id', 123);
        $this->shouldValidateExists('category', 'id', 1234, false);

        $this->assertPasses('category_id', 123);

        $this->assertNotPasses('category_id', 1234);
        $this->assertNotPasses('category_id', 'invalid id');
        $this->assertNotPasses('category_id', null);
    }
}