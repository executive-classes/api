<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Classroom\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index'])
    ->name('course.index')
    ->middleware('can:' . UserPrivilegeEnum::COURSE_GET);

Route::post('/courses', [CourseController::class, 'store'])
    ->name('course.store')
    ->middleware('can:' . UserPrivilegeEnum::COURSE_CREATE);

Route::get('/courses/{course}', [CourseController::class, 'show'])
    ->name('course.show')
    ->middleware('can:' . UserPrivilegeEnum::COURSE_GET);

Route::put('/courses/{course}', [CourseController::class, 'update'])
    ->name('course.update')
    ->middleware('can:' . UserPrivilegeEnum::COURSE_UPDATE);

Route::patch('/courses/{course}/reactivate', [CourseController::class, 'reactivate'])
    ->name('course.reactivate')
    ->middleware('can:' . UserPrivilegeEnum::COURSE_UPDATE);

Route::patch('/courses/{course}/cancel', [CourseController::class, 'cancel'])
    ->name('course.cancel')
    ->middleware('can:' . UserPrivilegeEnum::COURSE_UPDATE);