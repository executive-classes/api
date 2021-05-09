<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Billling\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/employees', [EmployeeController::class, 'index'])
    ->name('employee.index')
    ->middleware('can:' . UserPrivilegeEnum::EMPLOYEE_GET);

Route::post('/employees', [EmployeeController::class, 'store'])
    ->name('employee.store')
    ->middleware('can:' . UserPrivilegeEnum::EMPLOYEE_CREATE);

Route::get('/employees/{employee}', [EmployeeController::class, 'show'])
    ->name('employee.show')
    ->middleware('can:' . UserPrivilegeEnum::EMPLOYEE_GET);

Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
    ->name('employee.update')
    ->middleware('can:' . UserPrivilegeEnum::EMPLOYEE_UPDATE);

Route::delete('/employees/{employee}', [EmployeeController::class, 'cancel'])
    ->name('employee.cancel')
    ->middleware('can:' . UserPrivilegeEnum::EMPLOYEE_CANCEL);