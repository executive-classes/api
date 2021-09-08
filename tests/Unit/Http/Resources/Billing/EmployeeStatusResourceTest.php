<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\EmployeeStatus\EmployeeStatusCollection;
use App\Http\Resources\Billling\EmployeeStatus\EmployeeStatusResource;
use App\Models\Eloquent\Billing\EmployeeStatus\EmployeeStatus;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class EmployeeStatusResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new EmployeeStatusResource($this->makeOne(EmployeeStatus::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(EmployeeStatus::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new EmployeeStatusCollection($this->makeMany(EmployeeStatus::class));

        $this->assertInstanceOf(EmployeeStatusResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new EmployeeStatusResource($this->makeOne(EmployeeStatus::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'description',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new EmployeeStatusCollection($this->makeMany(EmployeeStatus::class));

        $this->runCollectionJsonAssertion($collection);
    }
}