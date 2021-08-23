<?php

namespace Tests\Unit\Http\Resources\General;

use App\Http\Resources\General\Category\CategoryCollection;
use App\Http\Resources\General\Category\CategoryResource;
use App\Models\Eloquent\General\Category\Category;
use Tests\Providers\General\CategoryProvider;
use Tests\Unit\Http\Resources\ResourceTestCase;

class CategoryResourceTest extends ResourceTestCase
{
    use CategoryProvider;

    public function test_resource()
    {
        $resource = new CategoryResource($this->category());

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Category::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new CategoryCollection($this->categories());

        $this->assertInstanceOf(CategoryResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new CategoryResource($this->category());

        $this->runResourceJsonAssertion($resource, [
            'name',
            'description',
            'type',
            'parent'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new CategoryCollection($this->categories());

        $this->runCollectionJsonAssertion($collection);
    }
}