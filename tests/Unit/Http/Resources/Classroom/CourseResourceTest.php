<?php

namespace Tests\Unit\Http\Resources\Classroom;

use App\Http\Resources\Classroom\Course\CourseCollection;
use App\Http\Resources\Classroom\Course\CourseResource;
use App\Models\Eloquent\Classroom\Course\Course;
use Tests\Providers\Classroom\CourseProvider;
use Tests\Unit\Http\Resources\ResourceTestCase;

class CourseResourceTest extends ResourceTestCase
{
    use CourseProvider;

    public function test_resource()
    {
        $resource = new CourseResource($this->course());

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Course::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new CourseCollection($this->courses());

        $this->assertInstanceOf(CourseResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new CourseResource($this->course());

        $this->runResourceJsonAssertion($resource, [
            'name',
            'active',
            'category'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new CourseCollection($this->courses());

        $this->runCollectionJsonAssertion($collection);
    }
}
