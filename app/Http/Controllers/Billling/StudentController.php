<?php

namespace App\Http\Controllers\Billling;

use App\Enums\Billing\StudentStatusEnum;
use App\Filters\Billing\StudentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\Student\CreateStudentRequest;
use App\Http\Requests\Billing\Student\UpdateStudentRequest;
use App\Http\Resources\Billling\StudentCollection;
use App\Http\Resources\Billling\StudentResource;
use App\Models\Billing\Biller;
use App\Models\Billing\Customer;
use App\Models\Billing\Student;

class StudentController extends Controller
{
    public function index(StudentFilter $filter)
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