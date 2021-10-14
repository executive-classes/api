<?php

namespace Tests\Unit\Http\Resources\Classroom;

use App\Http\Resources\Classroom\Test\TestCollection;
use App\Http\Resources\Classroom\Test\TestResource;
use App\Models\Eloquent\Classroom\Test\Test;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class TestResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new TestResource($this->makeOne(Test::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Test::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new TestCollection($this->makeMany(Test::class));

        $this->assertInstanceOf(TestResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new TestResource($this->makeOne(Test::class));

        $this->runResourceJsonAssertion($resource, [
            'name',
            'active',
            'category'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new TestCollection($this->makeMany(Test::class));

        $this->runCollectionJsonAssertion($collection);
    }
}
