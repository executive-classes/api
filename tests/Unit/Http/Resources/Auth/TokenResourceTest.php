<?php

namespace Tests\Unit\Http\Resources\Auth;

use App\Http\Resources\Auth\AccessToken\TokenResource;
use Laravel\Sanctum\NewAccessToken;
use Tests\Providers\Auth\TokenProvider;
use Tests\Unit\Http\Resources\ResourceTestCase;

class TokenResourceTest extends ResourceTestCase
{
    use TokenProvider;

    public function test_resource()
    {
        $resource = new TokenResource($this->makeOneNewAccessToken());

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(NewAccessToken::class, $resource->resource);
    }

    public function test_resource_json()
    {
        $resource = new TokenResource($this->makeOneNewAccessToken());

        $this->runResourceJsonAssertion($resource, [
            'plainTextToken',
            'user',
            'accessToken'
        ]);
    }
}