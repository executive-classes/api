<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billing\BillerStatus\BillerStatusCollection;
use App\Http\Resources\Billing\BillerStatus\BillerStatusResource;
use App\Models\Eloquent\Billing\BillerStatus\BillerStatus;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class BillerStatusResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new BillerStatusResource($this->makeOne(BillerStatus::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(BillerStatus::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new BillerStatusCollection($this->makeMany(BillerStatus::class));

        $this->assertInstanceOf(BillerStatusResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new BillerStatusResource($this->makeOne(BillerStatus::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'description',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new BillerStatusCollection($this->makeMany(BillerStatus::class));

        $this->runCollectionJsonAssertion($collection);
    }
}