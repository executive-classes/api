<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\User\UserCollection;
use App\Http\Resources\Billling\User\UserResource;
use App\Models\Eloquent\Billing\User\User;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class UserResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new UserResource($this->makeOne(User::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(User::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new UserCollection($this->makeMany(User::class));

        $this->assertInstanceOf(UserResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new UserResource($this->makeOne(User::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'created_at',
            'updated_at',
            'inactive_at',
            'reactive_at',
            'name',
            'email',
            'email_verified',
            'status',
            'active',
            'tax',
            'tax_alt',
            'phone',
            'phone_alt',
            'language',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new UserCollection($this->makeMany(User::class));

        $this->runCollectionJsonAssertion($collection);
    }
}