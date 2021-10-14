<?php

namespace Tests\Unit\Http\Resources\Classroom;

use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;
use App\Models\Eloquent\Classroom\Module\Module;
use App\Http\Resources\Classroom\Module\ModuleResource;
use App\Http\Resources\Classroom\Module\ModuleCollection;

class ModuleResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new ModuleResource($this->makeOne(Module::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Module::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new ModuleCollection($this->makeMany(Module::class));

        $this->assertInstanceOf(ModuleResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new ModuleResource($this->makeOne(Module::class));

        $this->runResourceJsonAssertion($resource, [
            'course',
            'name',
            'active',
            'category'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new ModuleCollection($this->makeMany(Module::class));

        $this->runCollectionJsonAssertion($collection);
    }
}
