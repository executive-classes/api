<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Enums\Billing\EmployeeStatusEnum;
use App\Models\Eloquent\Billing\Employee\Employee;
use App\Models\Eloquent\Billing\Employee\EmployeeFilters;
use App\Http\Resources\Billling\Employee\EmployeeResource;
use App\Http\Resources\Billling\Employee\EmployeeCollection;
use App\Http\Requests\Billing\Employee\CreateEmployeeRequest;
use App\Http\Requests\Billing\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index(EmployeeFilters $filter)
    {
        return new EmployeeCollection(Employee::filter($filter)->get());
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = new Employee($request->validated());
        $employee->user_id = $request->user_id;
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
        /** @todo Cancelar usuário */
        $employee->save();

        return new EmployeeResource($employee);
    }
}