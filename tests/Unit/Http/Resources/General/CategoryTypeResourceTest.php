<?php

namespace Tests\Unit\Http\Resources\General;

use App\Http\Resources\General\CategoryType\CategoryTypeResource;
use App\Models\Eloquent\General\CategoryType\CategoryType;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class CategoryTypeResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new CategoryTypeResource($this->makeOne(CategoryType::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(CategoryType::class, $resource->resource);
    }

    public function test_resource_json()
    {
        $resource = new CategoryTypeResource($this->makeOne(CategoryType::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name'
        ]);
    }

}