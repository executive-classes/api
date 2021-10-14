<?php

namespace Tests\Unit\Http\Resources\Classroom;

use App\Http\Resources\Classroom\Question\QuestionCollection;
use App\Http\Resources\Classroom\Question\QuestionResource;
use App\Models\Eloquent\Classroom\Question\Question;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class QuestionResourceTest extends ResourceTestCase
{
    use FactoryMaker;

    public function test_resource()
    {
        $resource = new QuestionResource($this->makeOne(Question::class));

        $this->runResourceAssertions($resource);
        $this->assertInstanceOf(Question::class, $resource->resource);
    }

    public function test_resource_collection()
    {
        $collection = new QuestionCollection($this->makeMany(Question::class));

        $this->assertInstanceOf(QuestionResource::class, $collection->resource[0]);
    }

    public function test_resource_json()
    {
        $resource = new QuestionResource($this->makeOne(Question::class));

        $this->runResourceJsonAssertion($resource, [
            'name',
            'question',
            'active',
            'category'
        ]);
    }

    public function test_resource_collection_json()
    {
        $collection = new QuestionCollection($this->makeMany(Question::class));

        $this->runCollectionJsonAssertion($collection);
    }
}
