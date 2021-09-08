<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\User\ProfileResource;
use App\Models\Eloquent\Billing\User\User;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class ProfileResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new ProfileResource($this->makeOne(User::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(User::class, $resource->resource);
    }
    
    public function test_resource_json()
    {
        $resource = new ProfileResource($this->makeOne(User::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'password_reminder',
            'email',
            'email_verified',
            'tax',
            'tax_alt',
            'phone',
            'phone_alt',
            'language',
        ]);
    }
}