<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billing\AddressCountry\AddressCountryCollection;
use App\Http\Resources\Billing\AddressCountry\AddressCountryResource;
use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class AddressCountryResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new AddressCountryResource($this->makeOne(AddressCountry::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(AddressCountry::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new AddressCountryCollection($this->makeMany(AddressCountry::class));

        $this->assertInstanceOf(AddressCountryResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new AddressCountryResource($this->makeOne(AddressCountry::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'short_name',
            'name',
            'name_pt'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new AddressCountryCollection($this->makeMany(AddressCountry::class));

        $this->runCollectionJsonAssertion($collection);
    }
}