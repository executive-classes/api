<?php

namespace Tests\Unit\Http\Resources\Classroom;

use App\Http\Resources\Classroom\Course\CourseCollection;
use App\Http\Resources\Classroom\Course\CourseResource;
use App\Models\Eloquent\Classroom\Course\Course;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class CourseResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new CourseResource($this->makeOne(Course::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Course::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new CourseCollection($this->makeMany(Course::class));

        $this->assertInstanceOf(CourseResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new CourseResource($this->makeOne(Course::class));

        $this->runResourceJsonAssertion($resource, [
            'name',
            'active',
            'category'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new CourseCollection($this->makeMany(Course::class));

        $this->runCollectionJsonAssertion($collection);
    }
}
