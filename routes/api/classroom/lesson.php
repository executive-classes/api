<?php

use Illuminate\Support\Facades\Route;
use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Classroom\LessonController;

Route::get('/lessons', [LessonController::class, 'index'])
    ->name('lesson.index')
    ->middleware('can:' . UserPrivilegeEnum::LESSON_GET);

Route::post('/lessons', [LessonController::class, 'store'])
    ->name('lesson.store')
    ->middleware('can:' . UserPrivilegeEnum::LESSON_CREATE);

Route::get('/lessons/{lesson}', [LessonController::class, 'show'])
    ->name('lesson.show')
    ->middleware('can:' . UserPrivilegeEnum::LESSON_GET);

Route::put('/lessons/{lesson}', [LessonController::class, 'update'])
    ->name('lesson.update')
    ->middleware('can:' . UserPrivilegeEnum::LESSON_UPDATE);

Route::patch('/lessons/{lesson}/reactivate', [LessonController::class, 'reactivate'])
    ->name('lesson.reactivate')
    ->middleware('can:' . UserPrivilegeEnum::LESSON_UPDATE);

Route::patch('/lessons/{lesson}/cancel', [LessonController::class, 'cancel'])
    ->name('lesson.cancel')
    ->middleware('can:' . UserPrivilegeEnum::LESSON_UPDATE);