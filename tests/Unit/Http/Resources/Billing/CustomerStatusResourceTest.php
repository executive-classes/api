<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billing\CustomerStatus\CustomerStatusCollection;
use App\Http\Resources\Billing\CustomerStatus\CustomerStatusResource;
use App\Models\Eloquent\Billing\CustomerStatus\CustomerStatus;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class CustomerStatusResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new CustomerStatusResource($this->makeOne(CustomerStatus::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(CustomerStatus::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new CustomerStatusCollection($this->makeMany(CustomerStatus::class));

        $this->assertInstanceOf(CustomerStatusResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new CustomerStatusResource($this->makeOne(CustomerStatus::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'description',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new CustomerStatusCollection($this->makeMany(CustomerStatus::class));

        $this->runCollectionJsonAssertion($collection);
    }
}