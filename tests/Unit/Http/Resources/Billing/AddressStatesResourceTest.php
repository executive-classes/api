<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\AddressState\AddressStateCollection;
use App\Http\Resources\Billling\AddressState\AddressStatesResource;
use App\Models\Eloquent\Billing\AddressState\AddressState;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class AddressStatesResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new AddressStatesResource($this->makeOne(AddressState::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(AddressState::class, $resource->resource);
    }

    public function test_resource_json()
    {
        $resource = new AddressStatesResource($this->makeOne(AddressState::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'abbr',
            'short_name',
            'name',
            'ie_mask'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new AddressStateCollection($this->makeMany(AddressState::class));

        $this->runCollectionJsonAssertion($collection);
    }
}