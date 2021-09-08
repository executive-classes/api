<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\Biller\BillerCollection;
use App\Http\Resources\Billling\Biller\BillerResource;
use App\Models\Eloquent\Billing\Biller\Biller;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class BillerResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new BillerResource($this->makeOne(Biller::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Biller::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new BillerCollection($this->makeMany(Biller::class));
        
        $this->assertInstanceOf(BillerResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new BillerResource($this->makeOne(Biller::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'created_at',
            'updated_at',
            'inactive_at',
            'reactive_at',
            'name',
            'tax',
            'tax_alt',
            'email',
            'phone',
            'phone_alt',
            'status',
            'interval',
            'payment_method',
            'customer',
            'address',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new BillerCollection($this->makeMany(Biller::class));

        $this->runCollectionJsonAssertion($collection);
    }
}