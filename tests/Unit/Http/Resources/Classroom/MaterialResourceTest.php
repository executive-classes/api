<?php

namespace Tests\Unit\Http\Resources\Classroom;

use App\Http\Resources\Classroom\Material\MaterialCollection;
use App\Http\Resources\Classroom\Material\MaterialResource;
use App\Models\Eloquent\Classroom\Material\Material;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class MaterialResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new MaterialResource($this->makeOne(Material::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Material::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new MaterialCollection($this->makeMany(Material::class));

        $this->assertInstanceOf(MaterialResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new MaterialResource($this->makeOne(Material::class));

        $this->runResourceJsonAssertion($resource, [
            'name',
            'title',
            'content',
            'style',
            'active',
            'category'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new MaterialCollection($this->makeMany(Material::class));

        $this->runCollectionJsonAssertion($collection);
    }
}
