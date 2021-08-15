<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\ResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

abstract class ResourceTestCase extends TestCase
{
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Run the resource default assertions.
     *
     * @param JsonResource $resource
     * @return void
     */
    protected function runResourceAssertions(JsonResource $resource) 
    {
        $this->assertEquals('data', $resource::$wrap);
        $this->assertEquals(['status' => true], $resource->additional);
    }

    /**
     * Run the resource default json assertions.
     *
     * @param JsonResource $resource
     * @param array $expected
     * @return void
     */
    protected function runResourceJsonAssertion(JsonResource $resource, array $expected)
    {
        $request = new Request();
        $response = new TestResponse($resource->toResponse($request));

        $response->assertJsonStructure([
            'status',
            'data' => $expected
        ]);
    }

    /**
     * Run the resource collection default assertions.
     *
     * @param ResourceCollection $collection
     * @return void
     */
    protected function runCollectionJsonAssertion(ResourceCollection $collection)
    {
        $request = new Request();
        $response = new TestResponse($collection->toResponse($request));

        $response->assertJsonStructure([
            'status',
            'data'
        ]);
    }
}