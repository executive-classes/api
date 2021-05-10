<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Billling\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/students', [StudentController::class, 'index'])
    ->name('student.index')
    ->middleware('can:' . UserPrivilegeEnum::STUDENT_GET);

Route::post('/students', [StudentController::class, 'store'])
    ->name('student.store')
    ->middleware('can:' . UserPrivilegeEnum::STUDENT_CREATE);

Route::get('/students/{student}', [StudentController::class, 'show'])
    ->name('student.show')
    ->middleware('can:' . UserPrivilegeEnum::STUDENT_GET);

Route::put('/students/{student}', [StudentController::class, 'update'])
    ->name('student.update')
    ->middleware('can:' . UserPrivilegeEnum::STUDENT_UPDATE);

Route::delete('/students/{student}', [StudentController::class, 'cancel'])
    ->name('student.cancel')
    ->middleware('can:' . UserPrivilegeEnum::STUDENT_CANCEL);