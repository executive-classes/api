<?php

namespace Tests\Unit\Http\Resources\System;

use App\Http\Resources\System\SystemLanguage\SystemLanguageCollection;
use App\Http\Resources\System\SystemLanguage\SystemLanguageResource;
use App\Models\Eloquent\System\SystemLanguage\SystemLanguage;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class SystemLanguageResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new SystemLanguageResource($this->makeOne(SystemLanguage::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(SystemLanguage::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new SystemLanguageCollection($this->makeMany(SystemLanguage::class));

        $this->assertInstanceOf(SystemLanguageResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new SystemLanguageResource($this->makeOne(SystemLanguage::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new SystemLanguageCollection($this->makeMany(SystemLanguage::class));

        $this->runCollectionJsonAssertion($collection);
    }
}