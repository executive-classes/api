<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\Employee\EmployeeCollection;
use App\Http\Resources\Billling\Employee\EmployeeResource;
use App\Models\Eloquent\Billing\Employee\Employee;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class EmployeeResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new EmployeeResource($this->makeOne(Employee::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Employee::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new EmployeeCollection($this->makeMany(Employee::class));

        $this->assertInstanceOf(EmployeeResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new EmployeeResource($this->makeOne(Employee::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'created_at',
            'updated_at',
            'user',
            'status',
            'position',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new EmployeeCollection($this->makeMany(Employee::class));

        $this->runCollectionJsonAssertion($collection);
    }
}