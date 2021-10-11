<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billing\PaymentInterval\PaymentIntervalCollection;
use App\Http\Resources\Billing\PaymentInterval\PaymentIntervalResource;
use App\Models\Eloquent\Billing\PaymentInterval\PaymentInterval;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class PaymentIntervalResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new PaymentIntervalResource($this->makeOne(PaymentInterval::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(PaymentInterval::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new PaymentIntervalCollection($this->makeMany(PaymentInterval::class));

        $this->assertInstanceOf(PaymentIntervalResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new PaymentIntervalResource($this->makeOne(PaymentInterval::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'description',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new PaymentIntervalCollection($this->makeMany(PaymentInterval::class));

        $this->runCollectionJsonAssertion($collection);
    }
}