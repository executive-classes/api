<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Billing\Student\Student;
use App\Enums\Billing\StudentStatusEnum;
use App\Models\Eloquent\Billing\Student\StudentFilters;
use App\Http\Resources\Billling\Student\StudentResource;
use App\Http\Resources\Billling\Student\StudentCollection;
use App\Http\Requests\Billing\Student\CreateStudentRequest;
use App\Http\Requests\Billing\Student\UpdateStudentRequest;

class StudentController extends Controller
{
    public function index(StudentFilters $filter)
    {
        return new StudentCollection(Student::filter($filter)->get());
    }

    public function store(CreateStudentRequest $request)
    {
        $student = new Student($request->validated());
        $student->save();
        
        return new StudentResource($student->refresh());
    }

    public function show(Student $student)
    {
        return new StudentResource($student);
    }
    
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->fill($request->validated());
        $student->save();

        return new StudentResource($student);
    }

    public function cancel(Student $student)
    {
        $student->student_status_id = StudentStatusEnum::CANCELED;
        /** @todo Cancelar usuário */
        $student->save();

        return new StudentResource($student);
    }
}