<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billing\EmployeePosition\EmployeePositionCollection;
use App\Http\Resources\Billing\EmployeePosition\EmployeePositionResource;
use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class EmployeePositionResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new EmployeePositionResource($this->makeOne(EmployeePosition::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(EmployeePosition::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new EmployeePositionCollection($this->makeMany(EmployeePosition::class));

        $this->assertInstanceOf(EmployeePositionResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new EmployeePositionResource($this->makeOne(EmployeePosition::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'parent',
            'children',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new EmployeePositionCollection($this->makeMany(EmployeePosition::class));

        $this->runCollectionJsonAssertion($collection);
    }
}