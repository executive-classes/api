<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\TeacherStatus\TeacherStatusCollection;
use App\Http\Resources\Billling\TeacherStatus\TeacherStatusResource;
use App\Models\Eloquent\Billing\TeacherStatus\TeacherStatus;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class TeacherStatusResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new TeacherStatusResource($this->makeOne(TeacherStatus::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(TeacherStatus::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new TeacherStatusCollection($this->makeMany(TeacherStatus::class));

        $this->assertInstanceOf(TeacherStatusResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new TeacherStatusResource($this->makeOne(TeacherStatus::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'description',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new TeacherStatusCollection($this->makeMany(TeacherStatus::class));

        $this->runCollectionJsonAssertion($collection);
    }
}