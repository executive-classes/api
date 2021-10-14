<?php

namespace Tests\Unit\Http\Resources\Classroom;

use App\Http\Resources\Classroom\Lesson\LessonCollection;
use App\Http\Resources\Classroom\Lesson\LessonResource;
use App\Models\Eloquent\Classroom\Lesson\Lesson;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class LessonResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new LessonResource($this->makeOne(Lesson::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Lesson::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new LessonCollection($this->makeMany(Lesson::class));

        $this->assertInstanceOf(LessonResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new LessonResource($this->makeOne(Lesson::class));

        $this->runResourceJsonAssertion($resource, [
            'course',
            'module',
            'name',
            'active',
            'category'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new LessonCollection($this->makeMany(Lesson::class));

        $this->runCollectionJsonAssertion($collection);
    }
}
