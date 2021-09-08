<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\Tax\TaxTypeCollection;
use App\Http\Resources\Billling\Tax\TaxTypeResource;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class TaxTypeResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new TaxTypeResource($this->makeOne(TaxType::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(TaxType::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new TaxTypeCollection($this->makeMany(TaxType::class));

        $this->assertInstanceOf(TaxTypeResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new TaxTypeResource($this->makeOne(TaxType::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'priority',
            'mask',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new TaxTypeCollection($this->makeMany(TaxType::class));

        $this->runCollectionJsonAssertion($collection);
    }
}