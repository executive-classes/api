<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\Teacher\TeacherCollection;
use App\Http\Resources\Billling\Teacher\TeacherResource;
use App\Models\Eloquent\Billing\Teacher\Teacher;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class TeacherResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new TeacherResource($this->makeOne(Teacher::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Teacher::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new TeacherCollection($this->makeMany(Teacher::class));

        $this->assertInstanceOf(TeacherResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new TeacherResource($this->makeOne(Teacher::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'created_at',
            'updated_at',
            'user',
            'status',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new TeacherCollection($this->makeMany(Teacher::class));

        $this->runCollectionJsonAssertion($collection);
    }
}