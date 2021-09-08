<?php

namespace Tests\Unit\Http\Resources\System;

use App\Http\Resources\System\SystemBugLog\SystemBugLogCollection;
use App\Http\Resources\System\SystemBugLog\SystemBugLogResource;
use App\Models\Eloquent\System\SystemBugLog\SystemBugLog;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class SystemBugLogResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new SystemBugLogResource($this->makeOne(SystemBugLog::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(SystemBugLog::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new SystemBugLogCollection($this->makeMany(SystemBugLog::class));

        $this->assertInstanceOf(SystemBugLogResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new SystemBugLogResource($this->makeOne(SystemBugLog::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'date',
            'user',
            'cross_user',
            'agent',
            'url',
            'route',
            'method',
            'ajax',
            'app',
            'error',
            'message',
            'data',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new SystemBugLogCollection($this->makeMany(SystemBugLog::class));

        $this->runCollectionJsonAssertion($collection);
    }
}