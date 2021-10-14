<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Classroom\Test\Test;
use App\Http\Resources\Classroom\Test\TestResource;
use App\Models\Eloquent\Classroom\Test\TestFilters;
use App\Http\Resources\Classroom\Test\TestCollection;
use App\Http\Requests\Classroom\Test\CreateTestRequest;
use App\Http\Requests\Classroom\Test\UpdateTestRequest;

class TestController extends Controller
{
    public function index(TestFilters $filter)
    {
        return new TestCollection(Test::filter($filter)->get());
    }

    public function store(CreateTestRequest $request)
    {
        $test = new Test($request->validated());
        $test->save();

        return new TestResource($test);
    }

    public function show(Test $test)
    {
        return new TestResource($test);
    }

    public function update(UpdateTestRequest $request, Test $test)
    {
        $test->fill($request->validated());
        $test->update();

        return new TestResource($test);
    }

    public function reactivate(Test $test)
    {
        $test->active = true;
        $test->update();

        return new TestResource($test);
    }

    public function cancel(Test $test)
    {
        $test->active = false;
        $test->update();

        return new TestResource($test);
    }
}