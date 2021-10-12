<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Billing\Teacher\Teacher;
use App\Enums\Billing\TeacherStatusEnum;
use App\Models\Eloquent\Billing\Teacher\TeacherFilters;
use App\Http\Resources\Billing\Teacher\TeacherResource;
use App\Http\Resources\Billing\Teacher\TeacherCollection;
use App\Http\Requests\Billing\Teacher\CreateTeacherRequest;
use App\Http\Requests\Billing\Teacher\UpdateTeacherRequest;

class TeacherController extends Controller
{
    public function index(TeacherFilters $filter)
    {
        return new TeacherCollection(Teacher::filter($filter)->get());
    }

    public function store(CreateTeacherRequest $request)
    {
        $teacher = new Teacher($request->validated());
        $teacher->save();
        
        return new TeacherResource($teacher);
    }

    public function show(Teacher $teacher)
    {
        return new TeacherResource($teacher);
    }
    
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->fill($request->validated());
        $teacher->update();

        return new TeacherResource($teacher);
    }

    public function cancel(Teacher $teacher)
    {
        $teacher->teacher_status_id = TeacherStatusEnum::CANCELED;
        /** @todo Cancelar usuário */
        $teacher->update();

        return new TeacherResource($teacher);
    }
}