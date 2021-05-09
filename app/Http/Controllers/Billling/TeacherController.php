<?php

namespace App\Http\Controllers\Billling;

use App\Enums\Billing\TeacherStatusEnum;
use App\Filters\Billing\TeacherFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\Employee\UpdateTeacherRequest;
use App\Http\Requests\Billing\Teacher\CreateTeacherRequest;
use App\Http\Resources\Billling\TeacherCollection;
use App\Http\Resources\Billling\TeacherResource;
use App\Models\Billing\Teacher;

class TeacherController extends Controller
{
    public function index(TeacherFilter $filter)
    {
        return new TeacherCollection(Teacher::filter($filter)->get());
    }

    public function store(CreateTeacherRequest $request)
    {
        $teacher = new Teacher($request->validated());
        $teacher->save();
        
        return new TeacherResource($teacher->refresh());
    }

    public function show(Teacher $teacher)
    {
        return new TeacherResource($teacher);
    }
    
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->fill($request->validated());
        $teacher->save();

        return new TeacherResource($teacher);
    }

    public function cancel(Teacher $teacher)
    {
        $teacher->teacher_status_id = TeacherStatusEnum::CANCELED;
        $teacher->save();

        return new TeacherResource($teacher);
    }
}