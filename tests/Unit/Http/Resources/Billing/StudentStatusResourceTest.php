<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\StudentStatus\StudentStatusCollection;
use App\Http\Resources\Billling\StudentStatus\StudentStatusResource;
use App\Models\Eloquent\Billing\StudentStatus\StudentStatus;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class StudentStatusResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new StudentStatusResource($this->makeOne(StudentStatus::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(StudentStatus::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new StudentStatusCollection($this->makeMany(StudentStatus::class));

        $this->assertInstanceOf(StudentStatusResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new StudentStatusResource($this->makeOne(StudentStatus::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'description',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new StudentStatusCollection($this->makeMany(StudentStatus::class));

        $this->runCollectionJsonAssertion($collection);
    }
}