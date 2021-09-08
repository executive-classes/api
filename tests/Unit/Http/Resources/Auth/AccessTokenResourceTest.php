<?php

namespace Tests\Unit\Http\Resources\Auth;

use App\Http\Resources\Auth\AccessToken\AccessTokenResource;
use Laravel\Sanctum\PersonalAccessToken;
use Tests\Providers\Auth\AccessTokenProvider;
use Tests\Unit\Http\Resources\ResourceTestCase;

class AccessTokenResourceTest extends ResourceTestCase
{
    use AccessTokenProvider;

    public function test_resource()
    {
        $resource = new AccessTokenResource($this->makeOneAccessToken());

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(PersonalAccessToken::class, $resource->resource);
    }

    public function test_resource_json()
    {
        $resource = new AccessTokenResource($this->makeOneAccessToken());

        $this->runResourceJsonAssertion($resource, [
            'name',
            'abilities',
            'tokenable_id',
            'tokenable_type',
            'updated_at',
            'created_at',
            'expires_at',
            'id'
        ]);
    }
}