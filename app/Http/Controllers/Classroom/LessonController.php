<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Classroom\Lesson\Lesson;
use App\Http\Resources\Classroom\Lesson\LessonResource;
use App\Models\Eloquent\Classroom\Lesson\LessonFilters;
use App\Http\Resources\Classroom\Lesson\LessonCollection;
use App\Http\Requests\Classroom\Lesson\CreateLessonRequest;
use App\Http\Requests\Classroom\Lesson\UpdateLessonRequest;

class LessonController extends Controller
{
    public function index(LessonFilters $filter)
    {
        return new LessonCollection(Lesson::filter($filter)->get());
    }

    public function store(CreateLessonRequest $request)
    {
        $lesson = new Lesson($request->validated());
        $lesson->save();

        return new LessonResource($lesson);
    }

    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->fill($request->validated());
        $lesson->update();

        return new LessonResource($lesson);
    }

    public function reactivate(Lesson $lesson)
    {
        $lesson->active = true;
        $lesson->update();

        return new LessonResource($lesson);
    }

    public function cancel(Lesson $lesson)
    {
        $lesson->active = false;
        $lesson->update();

        return new LessonResource($lesson);
    }
}