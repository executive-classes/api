<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Billling\TeacherController;
use App\Http\Controllers\Billling\TeacherStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/teachers', [TeacherController::class, 'index'])
    ->name('teacher.index')
    ->middleware('can:' . UserPrivilegeEnum::TEACHER_GET);

Route::post('/teachers', [TeacherController::class, 'store'])
    ->name('teacher.store')
    ->middleware('can:' . UserPrivilegeEnum::TEACHER_CREATE);

Route::get('/teachers/status', [TeacherStatusController::class, 'index'])
    ->name('teacher.status.index')
    ->middleware('can:' . UserPrivilegeEnum::TEACHER_GET);

Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])
    ->name('teacher.show')
    ->middleware('can:' . UserPrivilegeEnum::TEACHER_GET);

Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])
    ->name('teacher.update')
    ->middleware('can:' . UserPrivilegeEnum::TEACHER_UPDATE);

Route::delete('/teachers/{teacher}', [TeacherController::class, 'cancel'])
    ->name('teacher.cancel')
    ->middleware('can:' . UserPrivilegeEnum::TEACHER_CANCEL);