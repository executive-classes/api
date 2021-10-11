<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billing\PaymentMethod\PaymentMethodCollection;
use App\Http\Resources\Billing\PaymentMethod\PaymentMethodResource;
use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class PaymentMethodResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new PaymentMethodResource($this->makeOne(PaymentMethod::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(PaymentMethod::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new PaymentMethodCollection($this->makeMany(PaymentMethod::class));

        $this->assertInstanceOf(PaymentMethodResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new PaymentMethodResource($this->makeOne(PaymentMethod::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'description',
            'invoice_code',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new PaymentMethodCollection($this->makeMany(PaymentMethod::class));

        $this->runCollectionJsonAssertion($collection);
    }
}