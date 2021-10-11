<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billing\Customer\CustomerCollection;
use App\Http\Resources\Billing\Customer\CustomerResource;
use App\Models\Eloquent\Billing\Customer\Customer;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class CustomerResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new CustomerResource($this->makeOne(Customer::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Customer::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new CustomerCollection($this->makeMany(Customer::class));

        $this->assertInstanceOf(CustomerResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new CustomerResource($this->makeOne(Customer::class));

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
            'address',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new CustomerCollection($this->makeMany(Customer::class));

        $this->runCollectionJsonAssertion($collection);
    }
}