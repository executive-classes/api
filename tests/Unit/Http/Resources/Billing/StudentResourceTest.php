<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\Student\StudentCollection;
use App\Http\Resources\Billling\Student\StudentResource;
use App\Models\Eloquent\Billing\Student\Student;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class StudentResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new StudentResource($this->makeOne(Student::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Student::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new StudentCollection($this->makeMany(Student::class));

        $this->assertInstanceOf(StudentResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new StudentResource($this->makeOne(Student::class));

        $this->runResourceJsonAssertion($resource, [
            'id',
            'created_at',
            'updated_at',
            'customer',
            'user',
            'status',
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new StudentCollection($this->makeMany(Student::class));

        $this->runCollectionJsonAssertion($collection);
    }
}