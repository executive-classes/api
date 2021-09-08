<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\Address\AddressCollection;
use App\Http\Resources\Billling\Address\AddressResource;
use App\Models\Eloquent\Billing\Address\Address;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class AccessTokenResourceTest extends ResourceTestCase
{
    use FactoryMaker;
    
    public function test_resource()
    {
        $resource = new AddressResource($this->makeOne(Address::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Address::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new AddressCollection($this->makeMany(Address::class));

        $this->assertInstanceOf(AddressResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new AddressResource($this->makeOne(Address::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'zip',
            'street',
            'number',
            'complement',
            'district',
            'city',
            'state',
            'country',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new AddressCollection($this->makeMany(Address::class));

        $this->runCollectionJsonAssertion($collection);
    }
}