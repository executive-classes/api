<?php

namespace App\Http\Controllers\Classroom;

use App\Models\Classroom\Course\CourseFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classroom\Course\CreateCourseRequest;
use App\Http\Requests\Classroom\Course\UpdateCourseRequest;
use App\Http\Resources\Classroom\Course\CourseCollection;
use App\Http\Resources\Classroom\Course\CourseResource;
use App\Models\Classroom\Course\Course;

class CourseController extends Controller
{
    public function index(CourseFilters $filter)
    {
        return new CourseCollection(Course::filter($filter)->get());
    }

    public function store(CreateCourseRequest $request)
    {
        $course = new Course($request->validated());
        $course->save();

        return new CourseResource($course);
    }

    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->fill($request->validated());
        $course->update();

        return new CourseResource($course);
    }

    public function reactivate(Course $course)
    {
        $course->active = true;
        $course->update();

        return new CourseResource($course);
    }

    public function cancel(Course $course)
    {
        $course->active = false;
        $course->update();

        return new CourseResource($course);
    }
}