<?php

namespace App\Http\Controllers\Billling;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Filters\Billing\EmployeeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\Employee\CreateEmployeeRequest;
use App\Http\Requests\Billing\Employee\UpdateEmployeeRequest;
use App\Http\Resources\Billling\EmployeeCollection;
use App\Http\Resources\Billling\EmployeeResource;
use App\Models\Billing\Employee;
use App\Models\Billing\User;

class EmployeeController extends Controller
{
    public function index(EmployeeFilter $filter)
    {
        return new EmployeeCollection(Employee::filter($filter)->get());
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = new Employee($request->validated());
        $employee->save();
        
        return new EmployeeResource($employee->refresh());
    }

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }
    
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->fill($request->validated());
        $employee->save();

        return new EmployeeResource($employee);
    }

    public function cancel(Employee $employee)
    {
        $employee->employee_status_id = EmployeeStatusEnum::CANCELED;
        $employee->save();

        return new EmployeeResource($employee);
    }
}